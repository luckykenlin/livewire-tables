<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Support\Str;

trait Filter
{
    public $booleanFilters = [];
    public $dateFilters = [];
    public $multipleSelectFilter = [];

    public function initFilter()
    {
        foreach ($this->columns() as $column) {
            $column->canFilter() && $this->{$column->type . "Filters"}[$column->attribute] = '';
        }
    }

    public function addFilter()
    {
        $this->doBooleanFilters()->doDateFilters()->doMultipleSelectFilters();

        return $this;
    }

    public function doBooleanFilters()
    {
        if (count($this->booleanFilters) < 1) {
            return $this;
        }

        $this->query->where(function ($query) {
            foreach ($this->booleanFilters as $column => $value) {
                if (strlen($value)) {
                    $query->where($column, $value);
                }
            }
        });

        return $this;
    }

    public function doDateFilters()
    {
        if (count($this->dateFilters) < 1) {
            return $this;
        }

        $this->query->where(function ($query) {
            foreach ($this->dateFilters as $column => $value) {
                if (empty($value)) continue;
                $query->whereBetween($column, $this->getTimeRange($value));
            }
        });

        return $this;
    }

    public function doMultipleSelectFilters()
    {
        if (count($this->multipleSelectFilter) < 1) {
            return $this;
        }

        $this->query->where(function ($query) {
        });

        return $this;
    }

    public function getTimeRange($timeString)
    {
        return Str::of($timeString)
            ->replace(" ", "")
            ->explode("-")
            ->toArray();
    }
}
