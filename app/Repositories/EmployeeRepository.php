<?php

namespace App\Repositories;

use App\Contracts\EmployeeContract;
use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeRepository implements EmployeeContract
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * All List
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function all(array $filters): LengthAwarePaginator
    {
        return $this->employee->filters($filters)
            ->orderBy('id', $filters['order_by'] ?? 'desc')
            ->paginate($filters['size']);
    }

    public function save(array $payload): Employee
    {
        $employee = $this->employee->create($payload);

        return $employee;
    }

    public function update(array $payload, Employee $employee): Employee
    {
        $employee->update($payload);

        return $employee;
    }

    public function delete(Employee $employee): void
    {
        $employee->delete();
    }
}
