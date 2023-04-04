<?php

namespace App\Http\Controllers\User;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyResourceCollection;
use App\Repositories\CompanyRepository;

class CompanyController extends Controller
{
    private $repository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->repository = $companyRepository;
    }

    /**
     * @param PaginateRequest $request
     * @return CompanyResourceCollection
     */
    public function index(PaginateRequest $request): CompanyResourceCollection
    {
        $companies = $this->repository->all($request->validated());

        return (new CompanyResourceCollection($companies));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
         $company = $this->repository->save($request->validated());

        return (new CompanyResource($company));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return (new CompanyResource($company));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company = $this->repository->update($request->validated(), $company);

        return (new CompanyResource($company));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $this->repository->delete($company);

        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
