<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Support\Str;

/**
 * Trait Filter
 * @package Luckykenlin\LivewireTables\Traits
 */
trait Filter
{
    /**
     * @var array
     */
    public $booleanFilters = [];
    /**
     * @var array
     */
    public $dateFilters = [];
    /**
     * @var array
     */
    public $multipleSelectFilter = [];

    /**
     *
     */
    public function initFilter()
    {
        foreach ($this->columns() as $column) {
            $column->canFilter() && $this->{$column->type . "Filters"}[$column->attribute] = '';
        }
    }

    /**
     * @return $this
     */
    public function addFilter()
    {
        $this->doBooleanFilters()->doDateFilters()->doMultipleSelectFilters();

        return $this;
    }

    /**
     * @return $this
     */
    public function doBooleanFilters()
    {
        if (count($this->booleanFilters) < 1) {
            return $this;
        }

        $this->query->where(function ($query) {
            foreach ($this->booleanFilters as $column => $value) {
                if (strlen($value)) {
                    $query->where($this->getFilterColumn($column), $value);
                }
            }
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function doDateFilters()
    {
        if (count($this->dateFilters) < 1) {
            return $this;
        }

        $this->query->where(function ($query) {
            foreach ($this->dateFilters as $column => $value) {
                if (empty($value)) {
                    continue;
                }
                $query->whereBetween($this->getFilterColumn($column), $this->getTimeRange($value));
            }
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function doMultipleSelectFilters()
    {
        if (count($this->multipleSelectFilter) < 1) {
            return $this;
        }

        $this->query->where(function ($query) {
            //todo
        });

        return $this;
    }

    /**
     * @param $column
     * @return string
     */
    public function getFilterColumn($column)
    {
        if (Str::contains($column, '.')) {
            return $column;
        }

        return "{$this->getTable($this->query())}.$column";
    }

    /**
     * @param $timeString
     * @return array
     */
    public function getTimeRange($timeString)
    {
        return Str::of($timeString)
            ->replace(" ", "")
            ->explode("-")
            ->toArray();
    }
}
