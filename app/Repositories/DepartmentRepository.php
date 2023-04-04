<?php

namespace App\Repositories;

use App\Contracts\DepartmentContract;
use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentRepository implements DepartmentContract
{
    private $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    /**
     * All List
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function all(array $filters): LengthAwarePaginator
    {
        return $this->department->filters($filters)
            ->orderBy('id', $filters['order_by'] ?? 'desc')
            ->paginate($filters['size']);
    }

    public function save(array $payload): Department
    {
        $department = $this->department->create($payload);

        return $department;
    }

    public function update(array $payload, Department $department): Department
    {
        $department->update($payload);

        return $department;
    }

    public function delete(Department $department): void
    {
        $department->delete();
    }
}
