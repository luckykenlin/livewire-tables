<?php

namespace Luckykenlin\LivewireTables\Columns;


/**
 * Class Boolean
 * @package App\Tools
 */
class Boolean extends Column
{
    /**
     * @var string
     */
    public $type = 'boolean';

    public $trueValue = "Yes";
    public $falseValue = "No";

    public $view = "livewire-tables::boolean-field";

    public function trueValue($value)
    {
        $this->trueValue = $value;
        return $this;
    }

    public function falseValue($value)
    {
        $this->falseValue = $value;
        return $this;
    }
}
