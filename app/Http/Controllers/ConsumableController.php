<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsumablePostRequest;
use App\Http\Resources\ConsumableHistoryResource;
use App\Http\Resources\ConsumableResource;
use App\Models\Consumable;
use App\Models\ConsumableHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Response;

class ConsumableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ConsumableResource::collection(Consumable::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateItem(ConsumablePostRequest $request)
    {
        try {

            DB::beginTransaction();

            $fields = $request->validated();

            $consumable = Consumable::updateOrCreate(
                ['id' => $request->id],
                $fields
            );


            DB::commit();
            return (new ConsumableResource($consumable))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function addStock(Request $request, Consumable $consumable)
    {
        // Expected Payload
        // {
        //     quantity: [number]
        // }
        try {
            DB::beginTransaction();

            $consumable->quantity += $request->quantity;
            $consumable->save();

            DB::commit();
            return (new ConsumableResource($consumable))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function checkOut(Request $request, Consumable $consumable)
    {
        // Expected Payload
        // {
        //     consumable_id : 1
        //     received_by_id : 123
        //     agency : 123
        //     check_out_date : 2023/05/11
        //     quantity: 456
        // }
        try {
            DB::beginTransaction();

            $consumable_history = ConsumableHistory::create([
                'consumable_id' => $consumable->id,
                'received_by_id' => $request->received_by_id,
                'agency' => $request->agency,
                'check_out_date' => now(),
                'quantity' => $request->quantity
            ]);

            $consumable->quantity -= $request->quantity;
            $consumable->save();
            DB::commit();
            return (new ConsumableHistoryResource($consumable_history))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
