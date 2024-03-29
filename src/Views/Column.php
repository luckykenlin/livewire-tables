<?php

namespace Luckykenlin\LivewireTables\Views;

use Illuminate\Support\Str;

class Column
{
    /**
     * @var string
     */
    public static string $type = 'string';

    /**
     * @var string|null
     */
    public ?string $field;

    /**
     * @var string|null
     */
    public ?string $attribute;

    /**
     * @var array
     */
    public array $attributes = [];

    /**
     * @var string|null
     */
    protected ?string $class = null;

    /**
     * @var string|null
     */
    protected ?string $view = null;

    /**
     * @var bool
     */
    protected bool $blank = false;

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
    protected bool $selected = false;

    /**
     * @var bool
     */
    protected bool $hideOnExport = false;

    /**
     * @var bool
     */
    protected bool $hidden = false;

    /**
     * @var bool
     */
    protected bool $asHtml = false;

    /**
     * @var callable|null
     */
    protected $formatCallback = null;

    /**
     * @var callable|null
     */
    protected $renderCallback = null;

    /**
     * @var callable|null
     */
    protected $sortCallback = null;

    /**
     * @var callable|null
     */
    protected $searchCallback = null;

    /**
     * Column constructor.
     * @param string|null $field
     * @param string|null $attribute
     */
    public function __construct(?string $field = null, ?string $attribute = null)
    {
        $this->field = $field;

        $this->attribute = $attribute ?? Str::snake(Str::lower($field));
    }

    /**
     * @param string $field
     * @param string|null $attribute
     * @no-named-arguments
     *
     * @return Column
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
    public function searchable(?callable $callback = null): static
    {
        $this->searchable = true;

        $this->searchCallback = $callback;

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
    public function sortable(?callable $callback = null): static
    {
        $this->sortable = true;

        $this->sortCallback = $callback;

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
    public function hideOnExportIf(bool $shouldExport = true): static
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
     * Html column.
     */
    public function asHtml(): self
    {
        $this->asHtml = true;

        return $this;
    }

    /**
     * Html column.
     */
    public function notAsHtml(): self
    {
        $this->asHtml = false;

        return $this;
    }

    /**
     * Check if the column is raw.
     */
    public function isHtml(): bool
    {
        return $this->asHtml;
    }

    /**
     * @return bool
     */
    public function isExcludeFromExport(): bool
    {
        return $this->hideOnExport;
    }

    /**
     * @return bool
     */
    public function isIncludeFromExport(): bool
    {
        return ! $this->hideOnExport;
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
        $this->class = $this->class . ' ' . $class;

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
     * @param array $attributes
     *
     * @return $this
     */
    public function addAttributes(array $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return $this->attributes;
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
     * @return bool
     */
    public function hasSortCallback(): bool
    {
        return $this->sortCallback !== null;
    }

    /**
     * @return callable|null
     */
    public function getSortCallback(): ?callable
    {
        return $this->sortCallback;
    }

    /**
     * @return bool
     */
    public function hasSearchCallback(): bool
    {
        return $this->searchCallback !== null;
    }

    /**
     * @return callable|null
     */
    public function getSearchCallback(): ?callable
    {
        return $this->searchCallback;
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
    public function formatted(...$params)
    {
        return call_user_func_array($this->formatCallback, $params);
    }

    /**
     * Resolve column result.
     *
     * @param Column $column
     * @param object $model
     * @return mixed
     */
    public function resolveColumn(Column $column, object $model): mixed
    {
        // Get value from model
        $value = data_get($model, $column->getAttribute());

        // Invoke transform.
        $value = $column->transform($value);

        if ($column->isRenderable()) {
            return $column->renderCallback($model);
        }

        if ($column->isFormatted()) {
            return $column->formatted($value, $column, $model);
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

    /**
     * @param $value
     * @return mixed
     */
    public function transform($value): mixed
    {
        return $value;
    }
}
