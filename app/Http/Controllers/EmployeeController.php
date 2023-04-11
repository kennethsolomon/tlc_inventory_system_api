<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeePostRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all())->response()->setStatusCode(200);
    }

    /**
     * Create or Update the specified resource.
     *
     * @param  \App\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreateEmployee(EmployeePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = $request->validated();

            $employee = Employee::updateOrCreate(
                ['id' => $request->id],
                $fields
            );

            DB::commit();

            // $log = ['user' => auth()->user()->email, 'action' => 'Create/Update', 'description' => 'Employee with ID ' . $employee->id . ' has been created/updated.'];
            // Log::create($log);
            return (new EmployeeResource($employee))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return (new EmployeeResource($employee))->response()->setStatusCode(202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            DB::beginTransaction();
            $employee->delete();

            DB::commit();
            // $log = ['user' => auth()->user()->email, 'action' => 'Delete', 'description' => 'Employee with ' . $employee->id . ' has been deleted.'];
            // Log::create($log);

            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return response(null, Response::HTTP_NOT_IMPLEMENTED);
        }
    }
}
