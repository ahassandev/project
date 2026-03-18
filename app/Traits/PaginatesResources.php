<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait PaginatesResources
{
    /**
     * Scope a query to include search and pagination.
     * Expects $this->searchableFields to be defined on the Model if searching multiple custom fields,
     * otherwise defaults to searching the 'title' column.
     *
     * @param Builder $query
     * @param string|null $searchTerm
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function scopePaginateWithSearch(Builder $query, ?string $searchTerm = null, int $perPage = 10): LengthAwarePaginator
    {
        return $query->when($searchTerm, function ($q) use ($searchTerm) {
            $searchableFields = property_exists($this, 'searchableFields') ? $this->searchableFields : ['title'];
            
            $q->where(function($subQuery) use ($searchTerm, $searchableFields) {
                foreach ($searchableFields as $field) {
                    $subQuery->orWhere($field, 'like', "%{$searchTerm}%");
                }
            });
        })
        ->paginate($perPage)
        ->withQueryString();
    }
}
