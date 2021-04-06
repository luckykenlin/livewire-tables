<?php

namespace Luckykenlin\LivewireTables\Columns;

class MultipleSelect extends Column
{
    /**
     * @var string
     */
    public $type = 'multiple-select';

    public $component = "livewire-tables-multiple-select-filter";
}
