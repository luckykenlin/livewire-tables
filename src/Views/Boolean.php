<?php

namespace Luckykenlin\LivewireTables\Views;

class Boolean extends Column
{
    /**
     * @var string
     */
    public static string $type = 'boolean';

    /**
     * @var string
     */
    protected string $trueValue;

    /**
     * @var string
     */
    protected string $falseValue;

    /**
     * @param string|null $field
     * @param string|null $attribute
     */
    public function __construct(?string $field = null, ?string $attribute = null)
    {
        parent::__construct($field, $attribute);

        $this->trueValue = trans('livewire-tables::filters.trueValue');
        $this->falseValue = trans('livewire-tables::filters.falseValue');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function trueValue(string $value): static
    {
        $this->trueValue = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function falseValue(string $value): static
    {
        $this->falseValue = $value;

        return $this;
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function transform($value): string
    {
        return boolval($value) ? $this->trueValue : $this->falseValue;
    }
}
