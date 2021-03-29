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
    public string $type = 'boolean';

    public string $trueValue = "Yes";
    public string $falseValue = "No";

    public string $view = "livewire.boolean-field";

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
