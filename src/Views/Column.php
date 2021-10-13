<?php

namespace Luckykenlin\LivewireTables\Views;

use Closure;
use Illuminate\Support\Str;

class Column
{
    /**
     * @var string
     */
    public string $type = 'string';

    /**
     * @var string|null
     */
    public ?string $field;

    /**
     * @var string|null
     */
    public ?string $attribute;

    /**
     * @var string|null
     */
    public ?string $view;

    /**
     * @var string|null
     */
    public ?string $class = null;

    /**
     * @var bool
     */
    public bool $blank = false;

    /**
     * @var bool
     */
    public bool $searchable = false;

    /**
     * @var bool
     */
    public bool $sortable = false;

    /**
     * @var bool
     */
    public bool $selected = false;

    /**
     * @var bool
     */
    public bool $hideOnExport = false;

    /**
     * @var bool
     */
    public bool $hidden = false;

    /**
     * @var Closure|null
     */
    protected Closure|null $formatCallback = null;

    /**
     * @var Closure|null
     */
    protected Closure|null $renderCallback = null;

    /**
     * Column constructor.
     * @param string|null $field
     * @param string|null $attribute
     */
    public function __construct(?string $field, ?string $attribute)
    {
        $this->field = $field;

        $this->attribute = $attribute ?? Str::snake(Str::lower($field));
    }

    /**
     * @param string $field
     * @param string|null $attribute
     * @return static
     */
    public static function make(string $field, ?string $attribute = null): Column
    {
        return new static($field, $attribute);
    }

    /**
     * @return Column
     */
    public static function blank(): Column
    {
        return new static(null, null);
    }

    /**
     * @return string|null
     */
    public function getAttribute(): ?string
    {
        return $this->attribute;
    }

    /**
     * @return $this
     */
    public function searchable(): static
    {
        $this->searchable = true;

        return $this;
    }

    /**
     * @param bool $condition
     * @return $this
     */
    public function searchIf(bool $condition): static
    {
        $this->searchable = $condition;

        return $this;
    }

    /**
     * @return $this
     */
    public function sortable(): static
    {
        $this->sortable = true;

        return $this;
    }

    /**
     * @param bool $condition
     * @return $this
     */
    public function sortIf(bool $condition): static
    {
        $this->sortable = $condition;

        return $this;
    }

    /**
     * @param bool $shouldExport
     * @return $this
     */
    public function hideOnExport(bool $shouldExport = true): static
    {
        $this->hideOnExport = $shouldExport;

        return $this;
    }

    /**
     * @return $this
     */
    public function hide(): static
    {
        $this->hidden = true;

        return $this;
    }

    /**
     * @param bool $condition
     * @return $this
     */
    public function hideIf(bool $condition): static
    {
        $this->hidden = $condition;

        return $this;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden === true;
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->sortable === true;
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->searchable === true;
    }

    /**
     * @return bool
     */
    public function isRenderable(): bool
    {
        return is_callable($this->renderCallback);
    }

    /**
     * @return bool
     */
    public function isBlank(): bool
    {
        return $this->blank === true;
    }

    /**
     * @return bool
     */
    public function isFormatted(): bool
    {
        return is_callable($this->formatCallback);
    }

    /**
     * @return $this
     */
    public function excludeFromExport(): static
    {
        $this->hideOnExport = true;

        return $this;
    }

    /**
     * @param callable $callable
     *
     * @return $this
     */
    public function format(callable $callable): static
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * @param $view
     * @return $this
     */
    public function view($view): static
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function label($field): static
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * @param string $class
     *
     * @return $this
     */
    public function addClass(string $class): static
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return string|null
     */
    public function class(): ?string
    {
        return $this->class;
    }

    /**
     * Set the format callback.
     */
    public function render(callable $callable): static
    {
        $this->renderCallback = $callable;

        return $this;
    }

    /**
     * Render the callback.
     */
    public function renderCallback(object $model): object
    {
        return call_user_func($this->renderCallback, $model);
    }

    /**
     * Format the callback.
     */
    public function formatted($value)
    {
        return call_user_func($this->formatCallback, $value);
    }

    /**
     * Resolve column result.
     *
     * @param Column $column
     * @param object $model
     * @return array|false|mixed|object|string
     */
    public function resolveColumn(Column $column, object $model)
    {
        $value = data_get($model, $column->getAttribute());

        if ($column->isRenderable()) {
            return $column->renderCallback($model);
        }

        if ($column->isFormatted()) {
            return $column->formatted($value);
        }

        return $value ?? '';
    }

    /**
     * Check if the column has a relationship.
     */
    public function hasRelationship(): bool
    {
        return str_contains($this->attribute, '.');
    }
}
