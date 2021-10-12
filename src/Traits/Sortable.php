<?php

namespace Luckykenlin\LivewireTables\Traits;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Rappasoft\LaravelLivewireTables\Utilities\ColumnUtilities;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait Sortable
{
    /**
     * The initial field to be sorting by.
     */
    public array $sorts = [];

    /**
     * @var bool
     */
    public bool $sortingEnabled = true;

    /**
     * @var string
     */
    public string $defaultSortColumn = 'updated_at';
    /**
     * @var string
     */
    public string $defaultSortDirection = 'desc';

    public function applySorting(Builder $builder): Builder
    {
        if ($this->sortingEnabled === false) {
            return $builder;
        }

        if (!empty($this->defaultSortColumn) && !count($this->sorts)) {
            return $builder->orderBy($this->defaultSortColumn, $this->defaultSortDirection);
        }

        foreach ($this->sorts as $field => $direction) {

            if (!in_array($direction, ['asc', 'desc'])) {
                $direction = 'desc';
            }

            $column = $this->getColumn($field);

            if (is_null($column)) {
                continue;
            }

            $builder->orderBy($column->getAttribute(), $direction);
        }

        return $builder;

    }

    public function sortBy(string $field): ?string
    {
        if (!$this->sortingEnabled) {
            return null;
        }

        if (!isset($this->sorts[$field])) {
            return $this->sorts[$field] = 'asc';
        }

        if ($this->sorts[$field] === 'asc') {
            return $this->sorts[$field] = 'desc';
        }

        unset($this->sorts[$field]);

        return null;
    }

    public function removeSort(string $field): void
    {
        if (isset($this->sorts[$field])) {
            unset($this->sorts[$field]);
        }
    }

    public function resetSorts(): void
    {
        $this->sorts = [];
    }
}
