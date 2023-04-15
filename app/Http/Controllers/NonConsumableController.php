<?php

namespace App\Http\Controllers;

use App\Http\Requests\NonConsumablePostRequest;
use App\Http\Resources\NonConsumableHistoryResource;
use App\Http\Resources\NonConsumableResource;
use App\Models\NonConsumable;
use App\Models\NonConsumableHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NonConsumableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NonConsumableResource::collection(NonConsumable::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItem(NonConsumablePostRequest $request)
    {
        try {

            DB::beginTransaction();

            $fields = $request->validated();

            $consumable = NonConsumable::updateOrCreate(
                ['id' => $request->id],
                $fields
            );


            DB::commit();
            return (new NonConsumableResource($consumable))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function lendProperty(Request $request, NonConsumable $non_consumable)
    {
        try {
            DB::beginTransaction();

            $non_consumable_history = NonConsumableHistory::create([
                'non_consumable_id' => $non_consumable->id,
                'employee_id' => $request->employee_id,
                'date_of_lending' => $request->date_of_lending,
                'due_by_date' => $request->due_by_date,
                'condition_of_property' => $request->condition_of_property,
                'reason_for_lending' => $request->reason_for_lending,
                'returned_date' => $request->returned_date,
                'returned_notes' => $request->returned_notes,
            ]);

            $non_consumable->status = 'Unavailable';
            $non_consumable->assigned_to = $request->employee_id;
            $non_consumable->save();
            DB::commit();
            return (new NonConsumableHistoryResource($non_consumable_history))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function returnProperty(Request $request, NonConsumableHistory $non_consumable_history)
    {
        try {
            DB::beginTransaction();

            $non_consumable_history->returned_date = $request->returned_date;
            $non_consumable_history->returned_notes = $request->returned_notes;
            $non_consumable_history->save();

            $non_consumable = NonConsumable::whereId($non_consumable_history->non_consumable_id)->first();
            $non_consumable->status = 'Available';
            $non_consumable->save();
            DB::commit();
            return (new NonConsumableHistoryResource($non_consumable_history))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function getMaintenance()
    {
        $expired = [];
        $available = [];
        $non_consumables = NonConsumable::get()->toArray();
        foreach ($non_consumables as $non_consumable) {
            $warranty = $non_consumable['warranty_expiration'];
            $is_expired = Carbon::createFromFormat('m/d/Y', $warranty)->isPast();
            if ($is_expired) {
                $expired[] = ['warranty_expired_since' => Carbon::createFromFormat('m/d/Y', $warranty)->diffForHumans()] + $non_consumable;
            } else {
                $available[] = $non_consumable;
            }
        }

        return ['expired' =>  $expired, 'available' => $available];
    }
}
