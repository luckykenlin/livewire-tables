<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Sort
{
    public string $sort = '';
    public string $direction = 'desc';

    public function sort($field)
    {
        $this->sort === $field ? $this->reverseSort() : $this->sort = $field;
        $this->resetPage();
    }

    public function reverseSort()
    {
        $this->direction = $this->direction === "asc" ? "desc" : "asc";
    }

    public function sortableColumns(): array
    {
        return array_filter($this->columns(), fn ($column) => $column->sortable);
    }

    public function addSort(): self
    {
        if (! $this->sort) {
            return $this;
        }

        $this->query->orderBy($this->getSortColumn($this->query), $this->direction);

        return $this;
    }

    public function getSortColumn(Builder $builder): string
    {
        if (Str::contains($this->sort, '.')) {
            $relationship = $this->relationship($this->sort);

            return $this->attribute($builder, $relationship->name, $relationship->attribute);
        }

        return $this->sort;
    }
}
