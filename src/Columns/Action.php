<?php

namespace Luckykenlin\LivewireTables\Columns;

class Action extends Column
{
    /**
     * @var string
     */
    public $type = 'action';

    public $view = 'livewire-tables::table-actions';

    /**
     * @param string $name
     * @param null $attribute
     * @return static
     */
    public static function make($name = "Actions", $attribute = null)
    {
        return new static($name, $attribute);
    }
}
