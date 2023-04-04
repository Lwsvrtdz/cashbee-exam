<?php

namespace App\Contracts;

use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyContract
{
    /**
     * Get a paginated list of Companies.
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function all(array $filters): LengthAwarePaginator;

    /**
     * Save a new Company.
     *
     * @param array $payload
     * @return Company
     */
    public function save(array $payload): Company;

    /**
     * Update an existing Company.
     *
     * @param array $payload
     * @param Company $company
     * @return Company
     */
    public function update(array $payload, Company $company): Company;

    /**
     * Delete an Company.
     *
     * @param Company $company
     * @return void
     */
    public function delete(Company $company): void;
}
