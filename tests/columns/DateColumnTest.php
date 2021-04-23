<?php

namespace Luckykenlin\LivewireTables\Tests\Columns;

use Luckykenlin\LivewireTables\Columns\Date;
use Luckykenlin\LivewireTables\Tests\TestCase;

class DateColumnTest extends TestCase
{
    /** @test
     * @dataProvider settersColumnDataProvider
     */
    public function it_can_generate_a_column($name, $value)
    {
        $subject = Date::make($name, $value);
        $this->assertEquals($name, $subject->name);
        $this->assertEquals($value, $subject->attribute);
    }

    public function settersColumnDataProvider()
    {
        return [
            ['CreateDAt', 'created_at'],
            ['UpdatedAt', 'user.updated_at']
        ];
    }

    /**
     * @test
     * @dataProvider settersDataProvider
     */
    public function it_sets_properties_and_parameters($method, $value, $attribute)
    {
        $subject = Date::make('table.column')->$method($value);

        $this->assertEquals($value, $subject->$attribute);
    }

    public function settersDataProvider()
    {
        return [
            ['label', 'Bob Vance', 'name'],
            ['view', "index", 'view'],
            ['searchable', true, 'searchable'],
            ['sortable', true, 'sortable'],
            ['filterable', true, 'filterable'],
            ['hideOnTable', true, 'hideOnTable'],
            ['hideOnExport', true, 'hideOnExport'],
        ];
    }

    /** @test */
    public function it_returns_an_array_from_boolean_column()
    {
        $subject = Date::make('Created At', 'created_at')
            ->searchable()
            ->filterable()
            ->sortable()
            ->toArray();

        $this->assertEquals([
            'type' => 'date',
            'name' => 'Created At',
            'attribute' => 'created_at',
            'component' => 'livewire-tables-date-filter',
            'view' => '',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'hideOnExport' => false,
            'hideOnTable' => false,
            'exportable' => false,
            'formatCallback' => null
        ], $subject);
    }
}
