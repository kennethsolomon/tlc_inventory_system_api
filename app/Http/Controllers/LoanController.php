<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanPostRequest;
use App\Http\Resources\LoanResource;
use App\Models\Loan;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LoanController extends Controller
{
    public function index()
    {
        return LoanResource::collection(Loan::all())->response()->setStatusCode(200);
    }

    public function loanTrash()
    {
        return LoanResource::collection(Loan::onlyTrashed()->get())->response()->setStatusCode(200);
    }

    public function updateOrCreateLoan(LoanPostRequest $request)
    {
        try {

            DB::beginTransaction();

            $fields = $request->validated();

            $loan = Loan::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            $log = ['user' => auth()->user()->email, 'action' => 'Create/Update', 'description' => 'Loan  with ID ' . $loan->id . ' has been created/updated.'];
            Log::create($log);
            DB::commit();
            return (new LoanResource($loan))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    public function destroy(Loan $loan)
    {
        try {
            DB::beginTransaction();
            $loan->delete();

            DB::commit();

            $log = ['user' => auth()->user()->email, 'action' => 'Delete', 'description' => 'Loan with ' . $loan->id . ' has been deleted.'];
            Log::create($log);

            return response($loan, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
