<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            Department::class,
            'company_id',
            'department_id',
            'id',
            'id'
        );
    }

    public function employees()
    {
        // return $this->hasManyThrough(
        //     Employee::class,
        //     Department::class,
        //     'company_id',
        //     'department_id',
        //     'id',
        //     'id'
        // );

        return $this->hasMany(Employee::class);
    }


    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    /**
     * Scope Filters
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilters(Builder $query, array $filters): Builder
    {
        if (isset($filters['keyword'])) {
            $keyword = $filters['keyword'];

            $query->where('name', 'like', "%$keyword%");
        }

        if (auth()->check()) {
            $user = auth()->user();
            $company = $user->company;

            if ($company) {
                $query->where('company_id', $company->id);
            }
        }

        return $query;
    }
}
