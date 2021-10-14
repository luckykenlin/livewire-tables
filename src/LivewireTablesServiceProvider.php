<?php

namespace Luckykenlin\LivewireTables;

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
        });
    }
}
