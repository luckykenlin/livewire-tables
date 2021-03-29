<?php

namespace Luckykenlin\LivewireTables\Traits;

trait Filter
{
    public $filters = [];

    public function filterFields()
    {
        return array_filter($this->columns(), fn ($column) => $column->filterable);
    }
}
