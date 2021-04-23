<?php

namespace Luckykenlin\LivewireTables\Tests\Columns;

use Luckykenlin\LivewireTables\Columns\Boolean;
use Luckykenlin\LivewireTables\Tests\TestCase;

class BooleanColumnTest extends TestCase
{
    /** @test
     * @dataProvider settersColumnDataProvider
     */
    public function it_can_generate_a_column($name, $value)
    {
        $subject = Boolean::make($name, $value);
        $this->assertEquals($name, $subject->name);
        $this->assertEquals($value, $subject->attribute);
    }

    public function settersColumnDataProvider()
    {
        return [
            ['Feature', 'is_feature'],
            ['Feature', 'user.is_feature'],
        ];
    }

    /**
     * @test
     * @dataProvider settersDataProvider
     */
    public function it_sets_properties_and_parameters($method, $value, $attribute)
    {
        $subject = Boolean::make('table.column')->$method($value);

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
            ['trueValue', 'Y', 'trueValue'],
            ['falseValue', 'N', 'falseValue'],
        ];
    }

    /** @test */
    public function it_returns_an_array_from_boolean_column()
    {
        $subject = Boolean::make('Feature', 'is_feature')
            ->searchable()
            ->filterable()
            ->sortable()
            ->trueValue("Y")
            ->falseValue("N")
            ->toArray();

        $this->assertEquals([
            'type' => 'boolean',
            'name' => 'Feature',
            'attribute' => 'is_feature',
            'component' => 'livewire-tables-boolean-filter',
            'view' => 'livewire-tables::boolean-field',
            'trueValue' => 'Y',
            'falseValue' => 'N',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'hideOnExport' => false,
            'hideOnTable' => false,
            'exportable' => false,
            'formatCallback' => null,
        ], $subject);
    }
}
