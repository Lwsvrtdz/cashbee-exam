<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeResourceCollection;
use App\Repositories\EmployeeRepository;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $repository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->repository = $employeeRepository;
    }

    /**
     * @param PaginateRequest $request
     * @return EmployeeResourceCollection
     */
    public function index(PaginateRequest $request): EmployeeResourceCollection
    {
        $employees = $this->repository->all($request->validated());

        return (new EmployeeResourceCollection($employees));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $employee = $this->repository->save($request->validated());

        return (new EmployeeResource($employee));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return (new EmployeeResource($employee));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $employee = $this->repository->update($request->validated(), $employee);

        return (new EmployeeResource($employee));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $this->repository->delete($employee);

        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
