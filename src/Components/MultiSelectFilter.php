<?php

namespace Luckykenlin\LivewireTables\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Luckykenlin\LivewireTables\Helper;

class MultiSelectFilter extends Filter
{
    /**
     * @var string
     */
    public static string $type = 'single-select-filter';

    /**
     * Table column for filter.
     *
     * @var string
     */
    public string $column;

    /**
     * Select options.
     *
     * @var array
     */
    public array $options = [];

    /**
     * @param string      $column
     * @param string|null $label
     */
    public function __construct(string $column, ?string $label = null)
    {
        parent::__construct();

        $this->column = $column;

        $this->label = $label ?? Str::replace('_', ' ', Str::upper($column));

        $this->uriKey = $column;

        $this->view = 'livewire-tables::'.config('livewire-tables.theme').'.components.filters.multiple-select-filter';
    }

    /**
     * @param string      $column
     * @param string|null $label
     *
     * @return MultiSelectFilter
     */
    public static function make(string $column, ?string $label = null): MultiSelectFilter
    {
        return new static($column, $label);
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public function apply(Request $request, Builder $builder, mixed $value): Builder
    {
        $column = Helper::getTableColumn($builder, $this->column);

        return $builder->whereIn($column, $value);
    }

    /**
     * Define how filter value display on frontend.
     *
     * @param array $value
     *
     * @return string
     */
    public function displayValue(array $value): string
    {
        return collect($this->options)
            ->filter(function ($item, $key) use ($value) {
                return in_array($key, $value);
            })
            ->implode(', ');
    }

    /**
     * @param array $options
     *
     * @return SelectFilter
     */
    public function options(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Render filter view.
     *
     * @return View
     */
    public function render(): View
    {
        return view($this->view, [
            'uriKey'  => $this->uriKey,
            'label'   => $this->label,
            'options' => $this->options,
        ]);
    }
}
