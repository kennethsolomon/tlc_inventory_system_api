<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionPostRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
  public function updateOrCreateTransaction(TransactionPostRequest $request)
  {
    try {

      DB::beginTransaction();

      $fields = $request->validated();

      $transaction = Transaction::updateOrCreate(
        ['id' => $request->id],
        $fields
      );

      DB::commit();
      return (new TransactionResource($transaction))->response()->setStatusCode(201);
    } catch (\Throwable $th) {
      throw $th;
      DB::rollBack();
      return response(null, Response::HTTP_NOT_IMPLEMENTED);
    }
  }
}
