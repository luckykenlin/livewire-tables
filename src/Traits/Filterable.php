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
    public array $filters = [];

    /**
     * Trick of search.
     *
     * @param Builder $builder
     * @return Builder
     */
    protected function applyFilter(Builder $builder): Builder
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
    protected function getFilterValue($filter): mixed
    {
        return $this->filters[$filter->uriKey] ?? '';
    }

    /**
     * Reset filters.
     */
    public function resetFilters(): void
    {
        $this->filters = [];
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
    public function countFilters(): int
    {
        return collect($this->filters)
            ->reject(fn ($value) => $value === '')
            ->count();
    }
}
