<?php

namespace Luckykenlin\LivewireTables\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LivewireTablesCommand extends Command
{
    public $signature = 'make:table {name} {--model=Model}';

    public $description = 'Make livewire table.';

    public function handle()
    {
        $stub = File::get(__DIR__ . '/../../resources/stubs/component.stub');
        $stub = str_replace('DummyTable', $this->argument('name'), $stub);
        $stub = str_replace('DummyModel', $this->option('model'), $stub);
        $path = app_path('Http/Livewire/' . $this->argument('name') . '.php');

        File::ensureDirectoryExists(app_path('Http/Livewire'));

        if (!File::exists($path) || $this->confirm($this->argument('name') . ' already exists. Overwrite it?')) {
            File::put($path, $stub);
            $this->info($this->argument('name') . ' was made!');
        }
    }
}
