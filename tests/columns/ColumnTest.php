<?php

namespace Luckykenlin\LivewireTables\Tests\Columns;

use Luckykenlin\LivewireTables\Columns\Column;
use Luckykenlin\LivewireTables\Tests\TestCase;

class ColumnTest extends TestCase
{
    /** @test
     * @dataProvider settersColumnDataProvider
     */
    public function it_can_generate_a_column($name, $value)
    {
        $subject = Column::make($name, $value);
        $this->assertEquals($name, $subject->name);
        $this->assertEquals($value, $subject->attribute);
    }

    /**
     * @test
     * @dataProvider settersDataProvider
     */
    public function it_sets_properties_and_parameters($method, $value, $attribute)
    {
        $subject = Column::make('table.column')->$method($value);

        $this->assertEquals($value, $subject->$attribute);
    }

    public function settersColumnDataProvider()
    {
        return [
            ['Name', 'custom_name'],
            ['ID', 'user.id'],
        ];
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
    public function it_returns_an_array_from_column()
    {
        $subject = Column::make('table.column', 'id')
            ->label('Column')
            ->searchable()
            ->filterable()
            ->sortable()
            ->toArray();

        $this->assertEquals([
            'type' => 'string',
            'name' => 'Column',
            'attribute' => 'id',
            'component' => '',
            'view' => '',
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
