<?php

namespace Luckykenlin\LivewireTables\Commands;

use Illuminate\Console\Command;

class LivewireTablesCommand extends Command
{
    public $signature = 'livewire-tables';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
