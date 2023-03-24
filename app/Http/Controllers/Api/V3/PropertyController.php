<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Requests\PropertyPostRequest;
use App\Http\Resources\LendPropertyResource;
use App\Http\Resources\MaintenanceResource;
use App\Http\Resources\PropertyHistoryResource;
use App\Http\Resources\PropertyResource;
use App\Models\LendProperty;
use App\Models\Log;
use App\Models\Maintenance;
use App\Models\Property;
use App\Models\PropertyHistory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PropertyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PropertyResource::collection(Property::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateProperty(PropertyPostRequest $request)
    {
        try {

            DB::beginTransaction();
            $fields = $request->validated();

            $property = Property::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new PropertyResource($property))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        try {
            DB::beginTransaction();
            $property->delete();
            DB::commit();
            return response($property, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    // Transfer Property
    public function transferProperty(Request $request)
    {
        try {
            DB::beginTransaction();
            $count = 0;
            foreach ($request->selected as $selected_property) {
                info(__METHOD__ . ' : ' . $selected_property['id']);
                $data = [
                    'assigned_to' => $request->data['assigned_to'],
                    'init_transfer' => true,
                    'location' => $request->data['location'],
                    'status' => 'In Custody',
                ];

                Property::updateOrCreate(
                    ['id' => $selected_property['id']],
                    $data
                );

                $property_history_table = PropertyHistory::wherePropertyId($selected_property['id'])->latest()->first();

                if ($property_history_table) {
                    $property_history_table->status = 'Out of Custody';
                    $property_history_table->save();
                };

                $property_history = PropertyHistory::create([
                    'property_id' => $selected_property['id'],
                    'transfer_date' => $request->data['transfer_date'],
                    'assigned_to' => $request->data['assigned_to'],
                    'location' => $request->data['location'],
                    'status' => 'In Custody'
                ]);
                $count++;
            }

            DB::commit();
            return response($count . ' property has been transfered successfully.')->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function propertyHistory(Property $property)
    {
        return PropertyResource::collection(Property::with('propertyHistories')->whereId($property->id)->get())->response()->setStatusCode(200);
    }

    // Lend Property
    public function lendProperty(Request $request, Property $property)
    {
        info($request->all());
        try {
            DB::beginTransaction();

            if ($property->pending_lend) {
                throw new Exception("You must take action first for the pending lend property. Before lending the property again.", 500);
            }

            $property->pending_lend = true;
            $property->save();

            $lend_property = LendProperty::create([
                'property_id' => $property->id,
                'property_code' => $property->property_code,
                'category' => $property->category,
                'date_of_lending' => $request->date_of_lending,
                'borrower_name' => $request->borrower['fullname'],
                'user_id' => $request->borrower['id'],
                'location' => $request->location,
                'reason_for_lending' => $request->reason_for_lending,
                'is_lend' => false,
                'returned_date' => null
            ]);

            DB::commit();
            return (new LendPropertyResource($lend_property))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function lendApproved(Request $request, LendProperty $lend_property)
    {
        $lend_property->is_lend = true;
        $lend_property->save();

        $property = Property::whereId($lend_property->property_id)->first();

        $property->status = 'Unavailable';
        $property->pending_lend = false;
        $property->save();

        return (new PropertyResource($property))->response()->setStatusCode(201);
    }

    public function returnProperty(Request $request, LendProperty $lend_property)
    {
        $lend_property->returned_date = now('Asia/Manila');
        $lend_property->save();

        $property = Property::whereId($lend_property->property_id)->first();

        $property->status = 'In Custody';
        $property->save();

        return (new PropertyResource($property))->response()->setStatusCode(201);
    }

    public function cancelLend(Request $request, LendProperty $lend_property)
    {
        $property = Property::whereId($lend_property->property_id)->first();
        $property->pending_lend = false;
        $property->save();

        $lend_property->delete();
        return true;
    }

    public function lendList()
    {
        return LendPropertyResource::collection(LendProperty::all())->response()->setStatusCode(200);
    }

    // Maintenance

    public function onMaintenance(Request $request, Property $property)
    {
        try {
            DB::beginTransaction();
            $on_maintenance = Maintenance::create([
                'user_id' => auth()->user()->id,
                'property_id' => $property->id,
                'property_code' => $property->property_code,
                'category' => $property->category,
                'purchase_date' => $property->purchase_date,
                'warranty_period' => $property->warranty_period,
                'notes' => $request->notes,
                // 'custodian' => $request->custodian,
                'assigned_to' => $property->assigned_to,
                'location' => $property->location,
                'has_been_disposed' => false,
                'has_been_fixed' => false,
            ]);

            $property->status = 'In Repair';
            $property->save();

            DB::commit();
            return (new MaintenanceResource($on_maintenance))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function fixed(Maintenance $maintenance)
    {
        try {
            DB::beginTransaction();
            $maintenance->has_been_fixed = true;
            $maintenance->save();

            $property = Property::whereId($maintenance->property_id)->first();
            $property->status = 'In Custody';
            $property->save();
            DB::commit();

            return (new PropertyResource($property))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
    public function approve(Request $request, Maintenance $maintenance)
    {
        try {
            DB::beginTransaction();
            $maintenance->is_approved = true;
            $maintenance->custodian = $request->custodian;
            $maintenance->save();

            $property = Property::whereId($maintenance->property_id)->first();
            $property->status = 'In Repair';
            $property->save();
            DB::commit();

            return (new PropertyResource($property))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function disposed(Maintenance $maintenance)
    {
        try {
            DB::beginTransaction();
            $maintenance->has_been_disposed = true;
            $maintenance->save();

            $property = Property::whereId($maintenance->property_id)->first();
            $property->status = 'Disposed';
            $property->save();

            DB::commit();

            return (new PropertyResource($property))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function maintenanceList()
    {
        return MaintenanceResource::collection(Maintenance::all())->response()->setStatusCode(200);
    }

    public function userMaintenanceList()
    {
        return User::whereId(auth()->user()->id)->with('maintenances')->first();
    }
}
