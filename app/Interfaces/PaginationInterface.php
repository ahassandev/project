<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PaginationInterface
{
    /**
     * Scope a query to include search logic and return paginated results.
     *
     * @param Builder $query
     * @param string|null $searchTerm
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function scopePaginateWithSearch(Builder $query, ?string $searchTerm = null, int $perPage = 10): LengthAwarePaginator;
}
