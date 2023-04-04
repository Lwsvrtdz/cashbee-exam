<?php

namespace App\Contracts;

use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;

interface EmployeeContract
{
    /**
     * Get a paginated list of employees.
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function all(array $filters): LengthAwarePaginator;

    /**
     * Save a new employee.
     *
     * @param array $payload
     * @return Employee
     */
    public function save(array $payload): Employee;

    /**
     * Update an existing employee.
     *
     * @param array $payload
     * @param Employee $employee
     * @return Employee
     */
    public function update(array $payload, Employee $employee): Employee;

    /**
     * Delete an employee.
     *
     * @param Employee $employee
     * @return void
     */
    public function delete(Employee $employee): void;
}
