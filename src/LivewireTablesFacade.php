<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Luckykenlin\LivewireTables\LivewireTables
 */
class LivewireTablesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'livewire-tables';
    }
}
