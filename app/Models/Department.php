<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'company_id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
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

        if (isset($filters['company_id'])) {
            $query->where('company_id', $filters['company_id']);
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
