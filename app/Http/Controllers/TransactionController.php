<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionPostRequest;
use App\Http\Resources\ItemListResource;
use App\Http\Resources\TransactionResource;
use App\Models\Log;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{

  public function index()
  {
    return TransactionResource::collection(Transaction::all())->response()->setStatusCode(200);
  }

  public function transactionTrash()
  {
    return TransactionResource::collection(Transaction::onlyTrashed()->get())->response()->setStatusCode(200);
  }

  public function restore($id)
  {
    $log = ['user' => auth()->user()->email, 'action' => 'Restore', 'description' => 'Property with Transaction ID of ' . $id . ' has been restored.'];
    Log::create($log);
    return Transaction::withTrashed()->find($id)->restore();
  }

  public function updateOrCreateTransaction(TransactionPostRequest $request)
  {
    try {

      DB::beginTransaction();

      $fields = $request->validated();

      FacadesLog::debug($fields);
      $transaction = Transaction::updateOrCreate(
        ['id' => $request->id],
        $fields
      );

      $log = ['user' => auth()->user()->email, 'action' => 'Create/Update', 'description' => 'Property with Transaction ID of ' . $transaction->id . ' has been created/updated.'];
      Log::create($log);
      DB::commit();
      return (new TransactionResource($transaction))->response()->setStatusCode(201);
    } catch (\Throwable $th) {
      throw $th;
      DB::rollBack();
      return response(null, Response::HTTP_NOT_IMPLEMENTED);
    }
  }

  public function destroy(Transaction $transaction)
  {
    try {
      DB::beginTransaction();
      $transaction->delete();

      DB::commit();

      $log = ['user' => auth()->user()->email, 'action' => 'Delete', 'description' => 'Transaction with ' . $transaction->id . ' has been deleted.'];
      Log::create($log);

      return response($transaction, Response::HTTP_OK);
    } catch (\Throwable $th) {
      throw $th;
      DB::rollBack();
      return response(null, Response::HTTP_NOT_IMPLEMENTED);
    }
  }
}
