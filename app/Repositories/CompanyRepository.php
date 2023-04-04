<?php

namespace App\Repositories;

use App\Contracts\CompanyContract;
use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepository implements CompanyContract
{
    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * All List
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function all(array $filters): LengthAwarePaginator
    {
        return $this->company->filters($filters)
            ->orderBy('id', $filters['order_by'] ?? 'desc')
            ->paginate($filters['size']);
    }

    public function save(array $payload): Company
    {
        $company = $this->company->create($payload);

        return $company;
    }

    public function update(array $payload, Company $company): Company
    {
        $company->update($payload);

        return $company;
    }

    public function delete(Company $company): void
    {
        $company->delete();
    }
}
