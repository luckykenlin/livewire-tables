<?php

namespace Luckykenlin\LivewireTables\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Luckykenlin\LivewireTables\Helper;

class BooleanFilter extends Filter
{
    /**
     * @var string
     */
    public static string $type = 'boolean-filter';

    /**
     * Front show name.
     *
     * @var string
     */
    public string $name;

    /**
     * Table column for filter.
     *
     * @var string
     */
    public string $column;

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
     */
    public function __construct(string $column, ?string $name = null)
    {
        parent::__construct();

        $this->column = $column;

        $this->name = $name ?? Str::replace('_', ' ', Str::upper($column));

        $this->uriKey = $column;

        $this->view = 'livewire-tables::' . config('livewire-tables.theme') . '.components.filters.boolean-filter';

        $this->trueValue = trans('livewire-tables::filters.trueValue');

        $this->falseValue = trans('livewire-tables::filters.falseValue');
    }

    /**
     * @param string $column
     * @param string|null $name
     * @return BooleanFilter
     */
    public static function make(string $column, ?string $name = null): BooleanFilter
    {
        return new static($column, $name);
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public function apply(Request $request, Builder $builder, mixed $value): Builder
    {
        $column = Helper::getTableColumn($builder, $this->column);

        $value = $this->getBooleanValue($value);

        return $builder->where($column, $value);
    }

    /**
     * @return array
     */
    protected function options(): array
    {
        return [
            '' => trans('livewire-tables::filters.all'),
            'true' => $this->trueValue,
            'false' => $this->falseValue,
        ];
    }

    /**
     * Render filter view
     *
     * @return View
     */
    public function render(): View
    {
        return view($this->view, [
            'uriKey' => $this->uriKey,
            'name' => $this->name,
            'options' => $this->options(),
        ]);
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

    /**
     * @param string $name
     * @return BooleanFilter
     */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
