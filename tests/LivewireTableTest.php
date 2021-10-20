<?php

namespace Luckykenlin\LivewireTables\Tests;

use Carbon\Carbon;
use Livewire\Livewire;
use Luckykenlin\LivewireTables\Tests\Classes\DummyTable;
use Luckykenlin\LivewireTables\Tests\Models\DummyModel;

class LivewireTableTest extends TestCase
{
    /** @test */
//    public function it_can_mount_using_the_class()
//    {
//        DummyModel::factory()
//            ->state(['subject' => 'How to sell paper in Scranton PA'])
//            ->create();
//
//        $subject = Livewire::test(DummyTable::class)
//            ->assertSee('How to sell paper in Scranton PA');
//        $this->assertIsArray($subject->viewData('columns'));
//        $this->assertEquals([
//            0 => '#',
//            1 => 'Subject',
//            2 => 'Category',
//            3 => 'Flag',
//            4 => 'Body',
//            5 => 'Expiry',
//            6 => 'Updated At',
//            7 => 'Created At',
//        ], collect($subject->viewData('columns'))->map->name->toArray());
//    }

//
//    /** @test */
//    public function it_can_order_results()
//    {
//        DummyModel::factory()
//            ->state(['subject' => 'Beet growing for noobs'])
//            ->create();
//        DummyModel::factory()
//            ->state(['subject' => 'Advanced beet growing'])
//            ->create();
//
//        $subject = new DummyTable(1);
//        $this->assertEquals('Beet growing for noobs', $subject->models()->getCollection()[0]->subject);
//        $this->assertEquals('Advanced beet growing', $subject->models()->getCollection()[1]->subject);
//
//        $subject->forgetComputed();
//        $subject->sort = "subject";
//        $subject->direction = 'asc';
//
//        $this->assertEquals('Advanced beet growing', $subject->models()->getCollection()[0]->subject);
//        $this->assertEquals('Beet growing for noobs', $subject->models()->getCollection()[1]->subject);
//    }
//
//    /** @test */
//    public function it_can_filter_results_based_on_text()
//    {
//        DummyModel::factory()
//            ->state(['subject' => 'Beet growing for noobs'])
//            ->create();
//        DummyModel::factory()
//            ->state(['subject' => 'Advanced beet growing'])
//            ->create();
//
//        $subject = Livewire::test(DummyTable::class)
//            ->set('search', 'noobs');
//
//        $this->assertEquals(1, $subject->viewData("rows")->toArray()['total']);
//    }
//
//    /** @test */
//    public function it_can_filter_results_based_on_boolean()
//    {
//        DummyModel::factory()
//            ->state(['flag' => true])
//            ->create();
//        DummyModel::factory()
//            ->state(['flag' => false])
//            ->create();
//        DummyModel::factory()
//            ->state(['flag' => false])
//            ->create();
//
//        $subject = Livewire::test(DummyTable::class)
//            ->set('booleanFilters', [
//                "flag" => 0,
//            ]);
//
//        $this->assertEquals(2, $subject->viewData("rows")->toArray()['total']);
//
//        $subject = Livewire::test(DummyTable::class)
//            ->set('booleanFilters', [
//                "flag" => 1,
//            ]);
//
//        $this->assertEquals(1, $subject->viewData("rows")->toArray()['total']);
//    }
//
//    /** @test */
//    public function it_can_filter_results_based_on_date()
//    {
//        $now = Carbon::now();
//        $preWeek = Carbon::now()->subWeek();
//        DummyModel::factory()
//            ->state(['created_at' => $now])
//            ->create();
//        DummyModel::factory()
//            ->state(['created_at' => $now])
//            ->create();
//        DummyModel::factory()
//            ->state(['created_at' => $now])
//            ->create();
//        DummyModel::factory()
//            ->state(['created_at' => $preWeek])
//            ->create();
//
//        $subject = Livewire::test(DummyTable::class)
//            ->set('dateFilters', [
//                "created_at" => $preWeek->addDay()->format("Y/m/d") . " - " . $now->addDay()->format("Y/m/d"),
//            ]);
//        $this->assertEquals(3, $subject->viewData("rows")->toArray()['total']);
//    }
}
