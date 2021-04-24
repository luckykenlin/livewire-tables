<?php

namespace Luckykenlin\LivewireTables\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Facade as Facade;
use Livewire\LivewireServiceProvider;
use Luckykenlin\LivewireTables\LivewireTablesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

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

        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();
        Facade::setFacadeApplication(app());
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LivewireTablesServiceProvider::class,
        ];
    }

    public function makeACleanSlate()
    {
        Artisan::call('view:clear');
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('view.paths', [
            __DIR__.'/../views',
            resource_path('views'),
        ]);
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_livewire_tables_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
