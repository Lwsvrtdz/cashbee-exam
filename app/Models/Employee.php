<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'department_id',
        'company_id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
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

        if (isset($filters['department_id'])) {
            $query->where('department_id', $filters['department_id']);
        }

        if (auth()->check()) {
            $user = auth()->user();
            $query->whereHas('department', function ($q) use ($user) {
                $q->where('company_id', $user->company_id);
            });
        }

        return $query;
    }
}
