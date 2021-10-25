<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Luckykenlin\LivewireTables\Components\Filter;

trait Filterable
{
    /**
     * Show filter box.
     *
     * @var bool
     */
    public bool $showFilters = true;

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
                    fn($value) => !empty($value) && $filter->apply(request(), $builder, $value)
                );
            });

        return $builder;
    }

    /**
     * Get filter value.
     *
     * @param Filter $filter
     * @return mixed
     */
    protected function getFilterValue(Filter $filter): mixed
    {
        return $this->filters[$filter->getUriKey()] ?? null;
    }

    /**
     * Runs when any filter is changed
     */
    public function updatedFilters(): void
    {
        // Remove any url params that are empty
        $this->checkFilters();

        // Reset the page when filters are changed
        $this->resetPage();
    }

    /**
     * Removes any filters that are empty
     */
    protected function checkFilters(): void
    {
        foreach ($this->filters as $key => $filter) {
            if (filled($this->filters[$key])) {
                continue;
            }

            unset($this->filters[$key]);
        }
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
     * Set a given filter to null
     *
     * @param $filter
     */
    public function removeFilter($filter): void
    {
        if (!isset($this->filters[$filter])) {
            return;
        }

        unset($this->filters[$filter]);
    }

    /**
     * Count filter values.
     *
     * @return int
     */
    public function countFilters(): int
    {
        return collect($this->filters)
            ->reject(fn($value) => $value === '')
            ->count();
    }
}
