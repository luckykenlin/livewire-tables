<?php

namespace Luckykenlin\LivewireTables\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BooleanFilter extends Filter
{
    /**
     * @var string
     */
    public static string $type = 'boolean-filter';

    /**
     * @var string
     */
    protected string $trueValue;

    /**
     * @var string
     */
    protected string $falseValue;

    /**
     * @param string $column
     * @param string|null $name
     * @param string|null $view
     */
    public function __construct(string $column, ?string $name = null, ?string $view = null)
    {
        parent::__construct(column: $column);

        $this->name = $name ?? Str::replace('_', ' ', Str::upper($column));

        $this->uriKey = $this->uriKey();

        $this->view = $view ?? 'livewire-tables::' . config('livewire-tables.theme') . '.components.filters.boolean-filter';

        $this->trueValue = trans('livewire-tables::filters.trueValue');

        $this->falseValue = trans('livewire-tables::filters.falseValue');
    }

    /**
     * @param string $column
     * @return BooleanFilter
     */
    public static function make(string $column): BooleanFilter
    {
        return new static($column);
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(Request $request, Builder $query, mixed $value): Builder
    {
        $column = $this->getColumn($query);

        $value = $this->getBooleanValue($value);

        return $query->where($column, $value);
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return [
            '' => trans('livewire-tables::filters.all'),
            'true' => $this->trueValue,
            'false' => $this->falseValue,
        ];
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view($this->view(), [
            'uriKey' => $this->uriKey,
            'name' => $this->name,
            'options' => $this->options(),
        ]);
    }

    /**
     * @return string
     */
    public function view(): string
    {
        return 'livewire-tables::' . config('livewire-tables.theme') . '.components.filters.boolean-filter';
    }

    /**
     * Get the key for the filter.
     *
     * @return string
     */
    public function uriKey(): string
    {
        return 'boolean_' . $this->column;
    }

    /**
     * Set the true value.
     */
    public function trueValue(string $value): static
    {
        $this->trueValue = $value;

        return $this;
    }

    /**
     * Set the false value.
     */
    public function falseValue(string $value): static
    {
        $this->falseValue = $value;

        return $this;
    }

    /**
     * Get the boolean value.
     */
    private function getBooleanValue(string $value): bool
    {
        return $value === 'true';
    }
}
