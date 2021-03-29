<?php

namespace Luckykenlin\LivewireTables\Columns;

/**
 * Class ID
 * @package App\Tools
 */
class ID extends Column
{
    /**
     * @var string
     */
    public $type = 'id';

    /**
     * @param string $name
     * @param null $attribute
     * @return static
     */
    public static function make($name = "ID", $attribute = null)
    {
        return new static($name, $attribute);
    }
}
