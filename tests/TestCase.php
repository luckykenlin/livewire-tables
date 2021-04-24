<?php

namespace Luckykenlin\LivewireTables\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Luckykenlin\LivewireTables\LivewireTablesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Support\Facades\Facade as Facade;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->withFactories(__DIR__.'/database/factories');
        $this->artisan('migrate', ['--database' => 'sqlite'])->run();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Luckykenlin\\LivewireTables\\Tests\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LivewireTablesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
