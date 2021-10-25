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
     * [
     *   '$uriKey' => '$value'
     * ]
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
                    fn($value) => filled($value) && $filter->apply(request(), $builder, $value)
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
        foreach ($this->filters as $uriKey => $filter) {
            if (filled($this->filters[$uriKey])) {
                continue;
            }

            unset($this->filters[$uriKey]);
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
     * Set a given uriKey related filter to null
     *
     * @param $uriKey
     */
    public function removeFilter($uriKey): void
    {
        if (!isset($this->filters[$uriKey])) {
            return;
        }

        unset($this->filters[$uriKey]);
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

    /**
     * Get filter by uriKey.
     *
     * @param $uriKey
     * @return Filter
     */
    public function getFilterComponentByUriKey($uriKey): Filter
    {
        return collect($this->filters())
            ->firstWhere('uriKey', $uriKey);
    }

    /**
     * Get filter component name.
     *
     * @param $uriKey
     * @return string
     */
    public function getFilterComponentLabel($uriKey): string
    {
        $filter = $this->getFilterComponentByUriKey($uriKey);

        return $filter->getLabel();
    }


    /**
     * Get filter component value.
     *
     * @param $uriKey
     * @param $value
     * @return string
     */
    public function getFilterComponentValue($uriKey, $value): string
    {
        $filter = $this->getFilterComponentByUriKey($uriKey);

        if (method_exists($filter, 'displayValue')) {
            return $filter->displayValue($value);
        }

        return ucwords(strtr($value, ['_' => ' ', '-' => ' ']));
    }
}
