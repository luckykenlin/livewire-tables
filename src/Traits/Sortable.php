<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * The initial field to be sorting by.
     */
    public array $sorts = [];

    /**
     * Enable sorting.
     *
     * @var bool
     */
    public bool $sortingEnabled = true;

    /**
     * Set as single sorting.
     *
     * @var bool
     */
    public bool $singleColumnSorting = false;

    /**
     * Set default sort column.
     *
     * @var string
     */
    public string $defaultSortColumn = 'updated_at';

    /**
     * Set default sort direction.
     *
     * @var string
     */
    public string $defaultSortDirection = 'desc';

    /**
     * Trick of sorting.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function applySorting(Builder $builder): Builder
    {
        if ($this->sortingEnabled === false) {
            return $builder;
        }

        foreach ($this->sorts as $attribute => $direction) {
            if (! in_array($direction, ['asc', 'desc'])) {
                $direction = 'desc';
            }

            $builder->orderBy($this->getSortAttribute($builder, $attribute), $direction);
        }

        return $builder;
    }

    /**
     * Sort column onclick.
     *
     * @param string $attribute
     * @return string|string[]|null
     */
    public function sortBy(string $attribute): array|string|null
    {
        if (! $this->sortingEnabled) {
            return null;
        }

        if ($this->singleColumnSorting && count($this->sorts) && ! isset($this->sorts[$attribute])) {
            $this->sorts = [];
        }

        if (! isset($this->sorts[$attribute])) {
            return $this->sorts[$attribute] = 'asc';
        }

        if ($this->sorts[$attribute] === 'asc') {
            return $this->sorts[$attribute] = 'desc';
        }

        unset($this->sorts[$attribute]);

        return null;
    }

    /**
     * @param string $attribute
     */
    public function removeSort(string $attribute): void
    {
        if (isset($this->sorts[$attribute])) {
            unset($this->sorts[$attribute]);
        }
    }

    public function resetSorts(): void
    {
        $this->sorts = [];
    }

    /**
     * Get sort column with or without relation.
     *
     * @param Builder $builder
     * @param string $attribute
     * @return string
     */
    public function getSortAttribute(Builder $builder, string $attribute): string
    {
        // Check if the column has relationship
        if (str_contains($attribute, '.')) {
            $relationship = $this->relationship($attribute);

            // left join attribute by relationship.
            return $this->attribute($builder, $relationship->name, $relationship->attribute);
        }

        return sprintf('%s.%s', $this->getTable($builder), $attribute);
    }
}
