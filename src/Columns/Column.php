<?php

namespace Luckykenlin\LivewireTables\Columns;

use Illuminate\Support\Str;

/**
 * Class Column
 * @package App\Tools
 */
class Column
{
    /**
     * @var string
     */
    public string $type = 'string';

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $attribute;

    /**
     * @var bool
     */
    protected bool $searchable = false;

    /**
     * @var bool
     */
    protected bool $sortable = false;

    /**
     * @var bool
     */
    protected bool $filterable = false;

    /**
     * @var bool
     */
    protected bool $exportable = false;

    /**
     * @var string
     */
    protected string $view = '';

    /**
     * @var
     */
    protected $formatCallback;

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
     * @param null $name
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
    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFormatted(): bool
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
}
