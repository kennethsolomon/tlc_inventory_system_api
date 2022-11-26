<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanPostRequest;
use App\Http\Resources\LoanResource;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LoanController extends Controller
{
    public function index()
    {
        return LoanResource::collection(Loan::all())->response()->setStatusCode(200);
    }

    public function updateOrCreateLoan(LoanPostRequest $request)
    {
        try {

            DB::beginTransaction();

            $fields = $request->validated();

            $transaction = Loan::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();
            return (new LoanResource($transaction))->response()->setStatusCode(201);
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

            return response($loan, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
