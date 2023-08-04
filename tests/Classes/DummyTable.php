<?php

namespace Luckykenlin\LivewireTables\Tests\Classes;

use Illuminate\Database\Eloquent\Builder;
use Luckykenlin\LivewireTables\LivewireTables;
use Luckykenlin\LivewireTables\Tests\Models\DummyModel;
use Luckykenlin\LivewireTables\Views\Boolean;
use Luckykenlin\LivewireTables\Views\Column;

class DummyTable extends LivewireTables
{
    public function query(): Builder
    {
        return DummyModel::query();
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')->sortable(),
            Column::make("Subject")->searchable(),
            Column::make("Category"),
            Boolean::make("Flag")->trueValue("Marked")->falseValue("Unmarked")->filterable(),
            Column::make("Body"),
            Column::make("Expiry", "expires_at"),
            Column::make('Created At')->sortable(),
            Column::make('Updated At')->sortable(),
        ];
    }
}
