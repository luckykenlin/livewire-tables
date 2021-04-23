<?php

namespace Luckykenlin\LivewireTables\Tests\Columns;

use Luckykenlin\LivewireTables\Columns\Status;
use Luckykenlin\LivewireTables\Tests\TestCase;

class StatusColumnTest extends TestCase
{
    /** @test */
    public function it_can_generate_a_column()
    {
        $subject = Status::make("isOpen", 'is_open');
        $this->assertEquals("isOpen", $subject->name);
        $this->assertEquals('is_open', $subject->attribute);
    }

    /**
     * @test
     * @dataProvider settersDataProvider
     */
    public function it_sets_properties_and_parameters($method, $value, $attribute)
    {
        $subject = Status::make('table.column')->$method($value);

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
        $subject = Status::make('isOpen', 'is_open')
            ->searchable()
            ->filterable()
            ->sortable()
            ->toArray();

        $this->assertEquals([
            'type' => 'status',
            'name' => 'isOpen',
            'attribute' => 'is_open',
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
