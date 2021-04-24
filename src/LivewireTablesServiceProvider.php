<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Luckykenlin\LivewireTables\Commands\LivewireTablesCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Class LivewireTablesServiceProvider
 * @package Luckykenlin\LivewireTables
 */
class LivewireTablesServiceProvider extends PackageServiceProvider
{
    /**
     * Package configuration.
     *
     * @param Package $package
     */
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('livewire-tables')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_livewire_tables_table')
            ->hasCommand(LivewireTablesCommand::class);

        $this->configureComponents();
    }

    /**
     * Configure view components to laravel.
     */
    public function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('button');
            $this->registerComponent('secondary-button');
            $this->registerComponent('danger-button');
            $this->registerComponent('search-bar');
            $this->registerComponent('delete-action');
            $this->registerComponent('edit-action');
            $this->registerComponent('boolean-filter');
            $this->registerComponent('date-filter');
            $this->registerComponent('multiple-select-filter');
            $this->registerComponent('dialog-modal');
            $this->registerComponent('modal');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('livewire-tables::'.$component, 'livewire-tables-'.$component);
    }
}
