<?php

namespace App\Contracts;

use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;

interface DepartmentContract
{
    /**
     * Get a paginated list of Departments.
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function all(array $filters): LengthAwarePaginator;

    /**
     * Save a new Department.
     *
     * @param array $payload
     * @return Department
     */
    public function save(array $payload): Department;

    /**
     * Update an existing Department.
     *
     * @param array $payload
     * @param Department $department
     * @return Department
     */
    public function update(array $payload, Department $department): Department;

    /**
     * Delete an Department.
     *
     * @param Department $department
     * @return void
     */
    public function delete(Department $department): void;
}
