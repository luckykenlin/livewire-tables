<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use Luckykenlin\LivewireTables\Commands\LivewireTablesCommand;
use Luckykenlin\LivewireTables\Components\DeleteComponent;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * Class LivewireTablesServiceProvider
 * @package Luckykenlin\LivewireTables
 */
class LivewireTablesServiceProvider extends PackageServiceProvider
{
    public function bootingPackage(): void
    {
        Livewire::component('delete-button', DeleteComponent::class);

        Blade::component('livewire-tables::tailwind.components.table.table', 'livewire-tables::table');
        Blade::component('livewire-tables::tailwind.components.table.heading', 'livewire-tables::table.heading');
        Blade::component('livewire-tables::tailwind.components.table.footer', 'livewire-tables::table.footer');
        Blade::component('livewire-tables::tailwind.components.table.row', 'livewire-tables::table.row');
        Blade::component('livewire-tables::tailwind.components.table.cell', 'livewire-tables::table.cell');

        Blade::component('livewire-tables::tailwind.components.form.select', 'livewire-tables::form.select');
        Blade::component('livewire-tables::tailwind.components.filters.boolean-filter', 'livewire-tables::filters.boolean-filter');
    }

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
            ->hasTranslations()
            ->hasCommand(LivewireTablesCommand::class);
    }
}
