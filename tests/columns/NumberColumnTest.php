<?php

namespace Luckykenlin\LivewireTables\Tests\Columns;

use Luckykenlin\LivewireTables\Columns\Number;
use Luckykenlin\LivewireTables\Tests\TestCase;

class NumberColumnTest extends TestCase
{
    /** @test */
    public function it_can_generate_a_column()
    {
        $subject = Number::make("Likes", 'likes');
        $this->assertEquals("Likes", $subject->name);
        $this->assertEquals('likes', $subject->attribute);
    }

    /**
     * @test
     * @dataProvider settersDataProvider
     */
    public function it_sets_properties_and_parameters($method, $value, $attribute)
    {
        $subject = Number::make('table.column')->$method($value);

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
        $subject = Number::make('Likes', 'likes')
            ->searchable()
            ->filterable()
            ->sortable()
            ->toArray();

        $this->assertEquals([
            'type' => 'number',
            'name' => 'Likes',
            'attribute' => 'likes',
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
