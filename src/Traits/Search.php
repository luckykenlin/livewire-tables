<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Support\Str;

trait Search
{
    public $search = '';
    public $searchPlaceholder = 'Type for search..';
    public $searchable = true;

    public function clearSearch()
    {
        $this->search = '';
    }

    public function searchableColumns()
    {
        return array_filter($this->columns(), fn($column) => $column->searchable);
    }

    public function addSearch()
    {
        if (trim($this->search) === '' || !$this->searchable) {
            return $this;
        }

        $this->query->where(function ($builder) {
            foreach ($this->searchableColumns() as $column) {
                if (Str::contains($column->attribute, '.')) {
                    $relationship = $this->relationship($column->attribute);

                    $builder->orWhereHas($relationship->name, function ($builder) use ($relationship) {
                        $builder->where($relationship->attribute, 'like', '%' . trim($this->search) . '%');
                    });
                } else {
                    $builder->orWhere($builder->getModel()->getTable() . '.' . $column->attribute, 'like', '%' . trim($this->search) . '%');
                }
            }
        });

        return $this;
    }
}
