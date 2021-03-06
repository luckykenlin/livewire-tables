<?php

namespace Luckykenlin\LivewireTables\Columns;

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
    public static function make($name = "ID", $attribute = "id")
    {
        return new static($name, $attribute);
    }
}
