<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Search
{
    public string $search = '';
    public string $searchPlaceholder = 'Type for search..';
    public bool $searchable = true;

    public function clearSearch(): void
    {
        $this->search = '';
    }

    public function searchableColumns(): array
    {
        return array_filter($this->columns(), fn($column) => $column->searchable);
    }

    public function addSearch(): self
    {
        if (trim($this->search) === '' || !$this->searchable) {
            return $this;
        }

        $this->query->where(function (Builder $builder) {
            foreach ($this->searchableColumns() as $column) {
                if (Str::contains($column->attribute, '.')) {
                    $relationship = $this->relationship($column->attribute);

                    $builder->orWhereHas($relationship->name, function (Builder $builder) use ($relationship) {
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
