<?php

namespace Luckykenlin\LivewireTables\Tests\Classes;

use Illuminate\Database\Eloquent\Builder;
use Luckykenlin\LivewireTables\Columns\Boolean;
use Luckykenlin\LivewireTables\Columns\Column;
use Luckykenlin\LivewireTables\Columns\Date;
use Luckykenlin\LivewireTables\Columns\ID;
use Luckykenlin\LivewireTables\Columns\Text;
use Luckykenlin\LivewireTables\LivewireTables;
use Luckykenlin\LivewireTables\Tests\Models\DummyModel;

class DummyTable extends LivewireTables
{
    public function query(): Builder
    {
        return DummyModel::query();
    }

    public function columns(): array
    {
        return [
            ID::make()->label('#')->sortable(),
            Column::make('Subject')->searchable(),
            Column::make('Category'),
            Boolean::make('Flag')->trueValue('Marked')->falseValue('Unmarked')->filterable(),
            Text::make('Body'),
            Date::make('Expiry', 'expires_at'),
            Date::make('Updated At', 'updated_at')->hideOnTable(),
            Date::make('Created At', 'created_at'),
        ];
    }
}
