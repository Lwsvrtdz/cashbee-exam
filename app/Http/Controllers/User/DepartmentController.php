<?php

namespace App\Http\Controllers\User;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentResourceCollection;
use App\Repositories\DepartmentRepository;

class DepartmentController extends Controller
{
    private $repository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->repository = $departmentRepository;
    }

    /**
     * @param PaginateRequest $request
     * @return DepartmentResourceCollection
     */
    public function index(PaginateRequest $request): DepartmentResourceCollection
    {
        $departments = $this->repository->all($request->validated());

        return (new DepartmentResourceCollection($departments));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
         $department = $this->repository->save($request->validated());

        return (new DepartmentResource($department));
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return (new DepartmentResource($department));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $department = $this->repository->update($request->validated(), $department);

        return (new DepartmentResource($department));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $this->repository->delete($department);

        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
