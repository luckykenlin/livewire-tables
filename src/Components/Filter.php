<?php

namespace Luckykenlin\LivewireTables\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var string
     */
    public static string $type = 'filter';

    /**
     * Table column for filter.
     *
     * @var string|null
     */
    protected ?string $column;

    /**
     * Front show name.
     *
     * @var string
     */
    public string $name;

    /**
     * Unique key for filters component.
     *
     * @var string
     */
    public string $uriKey = '';

    /**
     * Front render view.
     *
     * @var string
     */
    public string $view;

    /**
     * @param string|null $column
     * @param string $uriKey
     * @param string $view
     */
    public function __construct(?string $column = null, string $uriKey = '', string $view = '')
    {
        $this->column = $column;
        $this->uriKey = $uriKey;
        $this->view = $view;
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    abstract public function apply(Request $request, Builder $query, mixed $value): Builder;

    /**
     * @param string $name
     * @return Filter
     */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function view(): string
    {
        return $this->view;
    }

    /**
     * @param string $view
     * @return Filter
     */
    public function setView(string $view): static
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the column name from table.
     */
    protected function getColumn(Builder $model, ?string $column = null): string
    {
        return sprintf(
            '%s.%s',
            // Table name
            $this->getTableNameFromBuilder($model),
            // Column name
            $column ?? $this->column,
        );
    }

    /**
     * Get the table name from the builder.
     */
    protected function getTableNameFromBuilder(Builder $builder): string
    {
        return $builder?->getQuery()?->from;
    }
}
