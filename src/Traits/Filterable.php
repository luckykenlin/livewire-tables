<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Show filter box.
     *
     * @var bool
     */
    public bool $showFilter = true;

    /**
     * Filter values.
     *
     * @var array
     */
    public array $filterValues = [];

    /**
     * Trick of search.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function applyFilter(Builder $builder): Builder
    {
        collect($this->filters())
            ->each(function ($filter) use ($builder) {
                tap(
                    $this->getFilterValue($filter),
                    fn ($value) => ! empty($value) && $filter->apply(request(), $builder, $value)
                );
            });

        return $builder;
    }

    /**
     * Get filter value.
     *
     * @param $filter
     * @return mixed
     */
    public function getFilterValue($filter): mixed
    {
        return $this->filterValues[$filter->uriKey] ?? '';
    }

    /**
     * Reset filters.
     */
    public function resetFilters(): void
    {
        $this->filterValues = [];
    }

    /**
     * Check if table has filters.
     *
     * @return bool
     */
    public function hasFilters(): bool
    {
        return count($this->filters());
    }

    /**
     * Count filter values.
     *
     * @return int
     */
    public function countFilterValues(): int
    {
        return collect($this->filterValues)
            ->reject(fn ($value) => $value === '')
            ->count();
    }
}
