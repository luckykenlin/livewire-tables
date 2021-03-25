<?php

namespace Luckykenlin\LivewireTables\Traits;

trait Filter
{
    public array $filters = [];

    public function filterFields(): array
    {
        return array_filter($this->columns(), fn($column) => $column->filterable);
    }
}
