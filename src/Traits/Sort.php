<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Trait Sort
 * @package Luckykenlin\LivewireTables\Traits
 */
trait Sort
{
    /**
     * @var string
     */
    public $sort = '';
    /**
     * @var string
     */
    public $direction = 'desc';

    /**
     * Sort by column.
     *
     * @param $column
     */
    public function sort($column)
    {
        $this->sort === $column ? $this->reverseSort() : $this->sort = $column;
        $this->resetPage();
    }

    /**
     * Reverse sort direction.
     */
    public function reverseSort()
    {
        $this->direction = $this->direction === "asc" ? "desc" : "asc";
    }

    /**
     * Get sortable columns.
     *
     * @return array
     */
    public function sortableColumns()
    {
        return array_filter($this->columns(), fn ($column) => $column->sortable);
    }

    /**
     * Execute sort action.
     *
     * @return $this
     */
    public function addSort()
    {
        if (! $this->sort) {
            return $this;
        }

        $this->query->orderBy($this->getSortColumn($this->query), $this->direction);

        return $this;
    }

    /**
     * Get sort column with or without relation.
     *
     * @param Builder $builder
     * @return string
     */
    public function getSortColumn(Builder $builder)
    {
        if (Str::contains($this->sort, '.')) {
            $relationship = $this->relationship($this->sort);

            /** left join when sort by relationship */
            return $this->attribute($builder, $relationship->name, $relationship->attribute);
        }

        return $this->sort;
    }
}
