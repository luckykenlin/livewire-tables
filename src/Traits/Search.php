<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Support\Str;

/**
 * Trait Search
 * @package Luckykenlin\LivewireTables\Traits
 */
trait Search
{
    /**
     * @var string
     */
    public $search = '';
    /**
     * @var string
     */
    public $searchPlaceholder = 'Type for search..';
    /**
     * @var bool
     */
    public $searchable = true;

    /**
     * Reset search.
     */
    public function clearSearch()
    {
        $this->search = '';
    }

    /**
     * Get searchable columns.
     *
     * @return array
     */
    public function searchableColumns()
    {
        return array_filter($this->columns(), fn ($column) => $column->searchable);
    }

    /**
     * Execute search action.
     *
     * @return $this
     */
    public function addSearch()
    {
        if (trim($this->search) === '' || ! $this->searchable) {
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
