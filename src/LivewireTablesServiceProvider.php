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
            ->hasTranslations()
            ->hasCommand(LivewireTablesCommand::class);

        $this->configureComponents();
    }

    /**
     * Configure view components to laravel.
     */
    public function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            Blade::component('livewire-tables::tailwind.datatable', 'livewire-tables::datatable');
            Blade::component('livewire-tables::tailwind.components.table.table', 'livewire-tables::table');
            Blade::component('livewire-tables::tailwind.components.table.heading', 'livewire-tables::table.heading');
            Blade::component('livewire-tables::tailwind.components.table.footer', 'livewire-tables::table.footer');
            Blade::component('livewire-tables::tailwind.components.table.row', 'livewire-tables::table.row');
            Blade::component('livewire-tables::tailwind.components.table.cell', 'livewire-tables::table.cell');

            Blade::component('livewire-tables::tailwind.components.table.table', 'livewire-tables::tw.table');
            Blade::component('livewire-tables::tailwind.components.table.heading', 'livewire-tables::tw.table.heading');
            Blade::component('livewire-tables::tailwind.components.table.footer', 'livewire-tables::tw.table.footer');
            Blade::component('livewire-tables::tailwind.components.table.row', 'livewire-tables::tw.table.row');
            Blade::component('livewire-tables::tailwind.components.table.cell', 'livewire-tables::tw.table.cell');

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
