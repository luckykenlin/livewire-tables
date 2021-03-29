<?php

namespace Luckykenlin\LivewireTables\Columns;


/**
 * Class Action
 * @package App\Tools
 */
class Action extends Column
{
    /**
     * @var string
     */
    public string $type = 'action';

    public bool $fixed = false;

    public string $view = 'livewire-tables::table-actions';

    /**
     * @param string $name
     * @param null $attribute
     * @return static
     */
    public static function make($name = "Actions", $attribute = null)
    {
        return new static($name, $attribute);
    }

    public function fixed()
    {
        $this->fixed = true;
        return $this;
    }
}
