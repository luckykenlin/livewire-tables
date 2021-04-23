<?php

namespace Luckykenlin\LivewireTables\Tests\Columns;

use Luckykenlin\LivewireTables\Columns\ID;
use Luckykenlin\LivewireTables\Tests\TestCase;

class IDColumnTest extends TestCase
{
    /** @test */
    public function it_can_generate_a_column()
    {
        $subject = ID::make();
        $this->assertEquals("ID", $subject->name);
        $this->assertEquals('id', $subject->attribute);
    }

    /**
     * @test
     * @dataProvider settersDataProvider
     */
    public function it_sets_properties_and_parameters($method, $value, $attribute)
    {
        $subject = ID::make('table.column')->$method($value);

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
        $subject = ID::make('Auth ID', 'id')
            ->searchable()
            ->filterable()
            ->sortable()
            ->toArray();

        $this->assertEquals([
            'type' => 'id',
            'name' => 'Auth ID',
            'attribute' => 'id',
            'component' => '',
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
