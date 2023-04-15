<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Requests\PropertyPostRequest;
use App\Http\Resources\LendPropertyResource;
use App\Http\Resources\MaintenanceResource;
use App\Http\Resources\PropertyHistoryResource;
use App\Http\Resources\PropertyResource;
use App\Models\GenerateMR;
use App\Models\LendProperty;
use App\Models\Log;
use App\Models\Maintenance;
use App\Models\Property;
use App\Models\PropertyHistory;
use App\Models\User;
use App\Services\MaintenanceService;
use Carbon\Carbon;
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
        return PropertyResource::collection(Property::with(['maintenances' => function($query) {
            $query->where('is_approved', false)->get();
        }])->get())->response()->setStatusCode(200);
        // return ['data' => Property::with('maintenances')->get()];
        // return Property::with('maintenances')->get();
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

            $fields = $request->validated();

            info('Creating a Property');
            $property = Property::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            Maintenance::where('property_id', $property->id)->delete();
            foreach ($request->maintenances as $maintenance) {
                info($maintenance);
                $MaintenanceService = MaintenanceService::getInstance();
                if (!isset($maintenance['id'])) {
                    $start_date = $maintenance['schedule_date'];
                    switch ($maintenance['frequency']) {
                        case 'Weekly':
                            info('Creating a weekly maintenance');
                            // $start_date = $MaintenanceService->getFrequencyDate($maintenance['schedule_date'], 'Weekly');
                            $maintenance_db = Maintenance::create([
                                'property_id' => $property->id,
                                'property_code' => $property->property_code,
                                'category' => $property->property_code,
                                'start_date' => $start_date,
                                // 'end_date' => Carbon::parse($start_date)->addDays(7)->format('Y-m-d'),
                                'end_date' => $start_date,
                                'description' => $property->description,
                                'notes' => $maintenance['maintenance_description'],
                                'part' => $maintenance['part'],
                                'schedule_date' => $maintenance['schedule_date'],
                                'frequency' => 'Weekly',
                            ]);
                            $MaintenanceService->plotMaintenance($maintenance_db);
                            break;
                        case 'Monthly':
                            info('Creating a monthly maintenance');
                            // $start_date = $MaintenanceService->getFrequencyDate($maintenance['schedule_date'], 'Monthly');
                            $maintenance_db = Maintenance::create([
                                'property_id' => $property->id,
                                'property_code' => $property->property_code,
                                'category' => $property->property_code,
                                'start_date' => $start_date,
                                // 'end_date' => Carbon::parse($start_date)->addDays(7)->format('Y-m-d'),
                                'end_date' => $start_date,
                                'description' => $property->description,
                                'notes' => $maintenance['maintenance_description'],
                                'part' => $maintenance['part'],
                                'schedule_date' => $maintenance['schedule_date'],
                                'frequency' => 'Monthly',
                            ]);
                            $MaintenanceService->plotMaintenance($maintenance_db);
                            break;
                        case 'Quarterly':
                            info('Creating a quarterly maintenance');
                            // $start_date = $MaintenanceService->getFrequencyDate($maintenance['schedule_date'], 'Quarterly');
                            $maintenance_db = Maintenance::create([
                                'property_id' => $property->id,
                                'property_code' => $property->property_code,
                                'category' => $property->property_code,
                                'start_date' => $start_date,
                                // 'end_date' => Carbon::parse($start_date)->addDays(7)->format('Y-m-d'),
                                'end_date' => $start_date,
                                'description' => $property->description,
                                'notes' => $maintenance['maintenance_description'],
                                'part' => $maintenance['part'],
                                'schedule_date' => $maintenance['schedule_date'],
                                'frequency' => 'Quarterly',
                            ]);
                            $MaintenanceService->plotMaintenance($maintenance_db);
                            break;
                        case 'Yearly':
                            info('Creating a yearly maintenance');
                            // $start_date = $MaintenanceService->getFrequencyDate($maintenance['schedule_date'], 'Yearly');
                            $maintenance_db = Maintenance::create([
                                'property_id' => $property->id,
                                'property_code' => $property->property_code,
                                'category' => $property->property_code,
                                'start_date' => $start_date,
                                // 'end_date' => Carbon::parse($start_date)->addDays(7)->format('Y-m-d'),
                                'end_date' => $start_date,
                                'description' => $property->description,
                                'notes' => $maintenance['maintenance_description'],
                                'part' => $maintenance['part'],
                                'schedule_date' => $maintenance['schedule_date'],
                                'frequency' => 'Yearly',
                            ]);
                            $MaintenanceService->plotMaintenance($maintenance_db);
                            break;
                        case 'Biennial':
                            info('Creating a biennial maintenance');
                            // $start_date = $MaintenanceService->getFrequencyDate($maintenance['schedule_date'], 'Biennial');
                            $maintenance_db = Maintenance::create([
                                'property_id' => $property->id,
                                'property_code' => $property->property_code,
                                'category' => $property->property_code,
                                'start_date' => $start_date,
                                // 'end_date' => Carbon::parse($start_date)->addDays(7)->format('Y-m-d'),
                                'end_date' => $start_date,
                                'description' => $property->description,
                                'notes' => $maintenance['maintenance_description'],
                                'part' => $maintenance['part'],
                                'schedule_date' => $maintenance['schedule_date'],
                                'frequency' => 'Biennial',
                            ]);
                            $MaintenanceService->plotMaintenance($maintenance_db);
                        default:
                            info('Creating a No Repeat maintenance');
                            $maintenance_db = Maintenance::create([
                                'property_id' => $property->id,
                                'property_code' => $property->property_code,
                                'category' => $property->property_code,
                                'start_date' => $maintenance['schedule_date'],
                                // 'end_date' => Carbon::parse($maintenance['schedule_date'])->addDays(7)->format('Y-m-d'),
                                'end_date' => $start_date,
                                'description' => $property->description,
                                'notes' => $maintenance['maintenance_description'],
                                'part' => $maintenance['part'],
                                'schedule_date' => $maintenance['schedule_date'],
                                'frequency' => 'No Repeat',
                            ]);
                            break;
                    }
                } else {
                    info('Updating a maintenance frequency');
                    $maintenance_db = Maintenance::where('id', $maintenance['id'])->latest()->first();
                    if($maintenance_db) {
                        $maintenance_db->frequency = $maintenance['frequency'] ?? null;
                        $maintenance_db->part = $maintenance['part'] ?? null;
                        $maintenance_db->notes = $maintenance['maintenance_description'] ?? null;
                        $maintenance_db->schedule_date = $maintenance['schedule_date'] ?? null;
                        $maintenance_db->save();
                    };
                }
            }

            info('Successfully finished creating a Property with Maintenance Data with Property Code: ' . $property->property_code);
            return (new PropertyResource($property))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
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
    // Damage
    public function setDamageProperty(Request $request)
    {
        if (count($request->selected) <= 0) {
            throw new Exception('No Selected Property.');
        }
        info($request->selected);
        try {
            DB::beginTransaction();
            $count = 0;
            foreach ($request->selected as $selected_property) {
                info(__METHOD__ . ' : ' . $selected_property['id']);

                if ($selected_property['status'] == 'Damaged' || $selected_property['status'] != 'On Stock') {
                    throw new Exception("Property with Property Code " . $selected_property['property_code'] . " is a damaged property.", 500);
                }

                $data = [
                    'status' => 'Damaged',
                ];

                Property::updateOrCreate(
                    ['id' => $selected_property['id']],
                    $data
                );
                $count++;
            }

            DB::commit();
            return response($count . ' property has been successfully tag as damaged.')->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    // Transfer Property
    public function transferProperty(Request $request)
    {
        if (count($request->selected) <= 0) {
            throw new Exception('No Selected Property.');
        }
        try {
            DB::beginTransaction();


            $selected_mr = [];

            $count = 0;
            foreach ($request->selected as $selected_property) {
                info(__METHOD__ . ' : ' . $selected_property['id']);

                $selected_property['assigned_to'] = $request->data['assigned_to'];

                array_push($selected_mr, $selected_property);

                if ($selected_property['status'] == 'Damaged') {
                    throw new Exception("Property with Property Code " . $selected_property['property_code'] . " is a damaged property.", 500);
                }
                if ($selected_property['status'] != 'On Stock') {
                    throw new Exception("Property with Property Code " . $selected_property['property_code'] . " is not available.", 500);
                }

                info($request->data);
                $data = [
                    'assigned_to' => $request->data['assigned_to'],
                    'init_transfer' => true,
                    'location' => $request->data['location'],
                    'status' => 'In Custody',
                    'reason_for_lending' => $request->data['reason_for_lending'],
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

            $generate_mr = GenerateMR::create([
                'type' => 'transfer',
                'selected' => json_encode($selected_mr),
            ]);

            info('Generate MR with ID ' . $generate_mr->id);

            if (!$generate_mr) {
                throw new Exception('Failed to generate MR.');
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
    public function lendProperty(Request $request)
    {
        if (count($request->selected) <= 0) {
            throw new Exception('No Selected Property.');
        }
        try {
            DB::beginTransaction();
            $count = 0;
            foreach ($request->selected as $selected_property) {

                if ($selected_property['status'] == 'Damaged' || $selected_property['status'] != 'On Stock') {
                    throw new Exception("Property with Property Code " . $selected_property['property_code'] . " is a damaged property.", 500);
                }

                $lend_property = LendProperty::whereUserId($request->data['borrower']['id'])
                    ->wherePropertyId($selected_property['id'])
                    ->whereIsLend(false)->get();

                if ($lend_property->count() > 0) {
                    throw new Exception("Property with Property Code " . $selected_property['property_code'] . " is already in pending. Please take actions before lending the property again.", 500);
                }

                $property = Property::find($selected_property['id']);
                if ($property) {
                    $property->pending_lend = true;
                    $property->save();
                }

                LendProperty::create(
                    [
                        'property_id' => $selected_property['id'],
                        'property_code' => $selected_property['property_code'],
                        'description' => $selected_property['description'],
                        'unit_cost' => $selected_property['unit_cost'],
                        'category' => $selected_property['category'],
                        'date_of_lending' => $request->data['date_of_lending'],
                        'return_date' => $request->data['return_date'],
                        'borrower_name' => $request->data['borrower']['fullname'],
                        'user_id' => $request->data['borrower']['id'],
                        'location' => $request->data['location'],
                        'reason_for_lending' => $request->data['reason_for_lending'],
                        'is_lend' => false,
                        'returned_date' => null
                    ]
                );

                $count++;
            }

            DB::commit();
            return response($count . ' property has been transfered successfully.')->setStatusCode(201);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function lendApproved(Request $request)
    {
        if (count($request->selected) <= 0) {
            throw new Exception('No Selected Property.');
        }
        try {
            DB::beginTransaction();

            $generate_mr = GenerateMR::create([
                'type' => 'lend',
                'selected' => json_encode($request->selected),
            ]);

            info('Generate MR with ID ' . $generate_mr->id);

            if (!$generate_mr) {
                throw new Exception('Failed to generate MR.');
            }

            $count = 0;
            foreach ($request->selected as $property) {
                if ($property['is_lend']) {
                    throw new Exception("Property with Property Code " . $property['property_code'] . " is already lend.");
                }
                $lend_property = LendProperty::whereId($property['id'])->first();
                $lend_property->is_lend = true;
                $lend_property->save();

                $property_db = Property::whereId($lend_property->property_id)->first();

                $property_db->status = 'In Custody';
                $property_db->pending_lend = false;
                $property_db->location = $lend_property->location;
                $property_db->save();

                $delete_pending = LendProperty::where('property_id', $lend_property->property_id)->where('is_lend', false)->delete();
                $count++;
            }

            DB::commit();
            return response($count . ' property has been approved successfully.')->setStatusCode(200);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function returnProperty(Request $request)
    {
        if (count($request->selected) <= 0) {
            throw new Exception('No Selected Property.');
        }
        try {
            DB::beginTransaction();
            $count = 0;
            foreach ($request->selected as $property) {
                if (!$property['is_lend']) {
                    throw new Exception("Property with Property Code " . $property['property_code'] . " is not yet approved.");
                }

                if ($property['returned_date']) {
                    throw new Exception("Property with Property Code " . $property['property_code'] . " is already returned.");
                }
                $lend_property = LendProperty::whereId($property['id'])->first();
                $lend_property->returned_date = now('Asia/Manila');
                $lend_property->save();

                $property_db = Property::whereId($lend_property->property_id)->first();

                $property_db->status = 'On Stock';
                $property_db->save();
                $count++;
            }

            DB::commit();
            return response($count . ' property has been returned successfully.')->setStatusCode(200);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function cancelLend(Request $request)
    {
        if (count($request->selected) <= 0) {
            throw new Exception('No Selected Property.');
        }
        try {
            DB::beginTransaction();
            $count = 0;

            foreach ($request->selected as $property) {
                if ($property['is_lend']) {
                    throw new Exception("Property with Property Code " . $property['property_code'] . " is already lend and cannot be cancelled.");
                }
                $lend_property = LendProperty::whereId($property['id'])->first();
                $property_db = Property::whereId($lend_property->property_id)->first();
                $property_db->pending_lend = false;
                $property_db->save();

                $lend_property->delete();
            }
            DB::commit();
            return response($count . ' property has been cancelled successfully.')->setStatusCode(200);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
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
                // 'warranty_period' => $property->warranty_period,
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
    public function changeMaintenanceStatus(Request $request, Maintenance $maintenance)
    {
        $status = $request->has_been_fixed ? 'Done' : 'Pending';
        info('Changing Property Maintenance Status for ' . $maintenance->property_code . ' to ' . $status . '');
        $maintenance->has_been_fixed = $request->has_been_fixed;
        $maintenance->save();
    }

    public function resignOwner(Request $request, Property $property)
    {
        if ($property->assigned_to) {
            $property->init_transfer = false;
            $property->assigned_to = null;
            $property->location = null;
            $property->status = 'On Stock';
            $property->save();

            $property_history_table = PropertyHistory::wherePropertyId($property->id)->latest()->first();
            $property_history_table->status = 'Out of Custody';
            $property_history_table->save();
        } else {
            throw new Exception("Property needs to be transferred.", 500);
        }
    }
}
