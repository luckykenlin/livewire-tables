<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Support\Facades\Blade;
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

        $this->registerComponents();
    }

    /**
     * Register view components to laravel.
     */
    public function registerComponents()
    {
        Blade::component('livewire-tables::search-bar', 'livewire-tables-search-bar');
        Blade::component('livewire-tables::delete-action', 'livewire-tables-delete-action');
        Blade::component('livewire-tables::edit-action', 'livewire-tables-edit-action');
        Blade::component('livewire-tables::boolean-filter', 'livewire-tables-boolean-filter');
        Blade::component('livewire-tables::date-filter', 'livewire-tables-date-filter');
        Blade::component('livewire-tables::multiple-select-filter', 'livewire-tables-multiple-select-filter');
    }
}
