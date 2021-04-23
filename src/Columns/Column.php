<?php

namespace Luckykenlin\LivewireTables\Columns;

use Illuminate\Support\Str;

class Column
{
    /**
     * @var string
     */
    public $type = 'string';

    /**
     * @var string
     */
    public $component = '';


    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $attribute;

    /**
     * @var bool
     */
    public $searchable = false;

    /**
     * @var bool
     */
    public $sortable = false;

    /**
     * @var bool
     */
    public $filterable = false;

    /**
     * @var bool
     */
    public $hideOnExport = false;

    /**
     * @var bool
     */
    public $hideOnTable = false;

    /**
     * @var bool
     */
    public $exportable = false;

    /**
     * @var string
     */
    public $view = '';

    /**
     * @var
     */
    public $formatCallback;

    /**
     * Column constructor.
     * @param $name
     * @param $attribute
     */
    public function __construct($name, $attribute)
    {
        $this->name = $name;
        $this->attribute = $attribute ?? Str::snake(Str::lower($name));
    }

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * @return $this
     */
    public function searchable()
    {
        $this->searchable = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function sortable()
    {
        $this->sortable = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function filterable()
    {
        $this->filterable = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function hideOnExport()
    {
        $this->hideOnExport = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function hideOnTable()
    {
        $this->hideOnTable = true;

        return $this;
    }

    /**
     * @param string $name
     * @param null $attribute
     * @return static
     */
    public static function make($name, $attribute = null)
    {
        return new static($name, $attribute);
    }

    /**
     * @param callable $callable
     *
     * @return $this
     */
    public function format(callable $callable)
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFormatted()
    {
        return is_callable($this->formatCallback);
    }

    /**
     * @param $view
     * @return $this
     */
    public function view($view)
    {
        $this->view = $view;

        return $this;
    }

    public function label($name)
    {
        $this->name = $name;

        return $this;
    }

    public function canFilter()
    {
        return $this->filterable && $this->component;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
