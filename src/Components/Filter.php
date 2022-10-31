<?php

namespace Luckykenlin\LivewireTables\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var string
     */
    public static string $type = 'filter';

    /**
     * Unique key for filters component.
     *
     * @var string
    */
    public string $uriKey = '';

    /**
     * @var string
     */
    public string $label = '';

    /**
     * Front render view.
     *
     * @var string
     */
    public string $view;

    /**
     * @param string|null $uriKey
     */
    public function __construct(?string $uriKey = '')
    {
        $this->uriKey = $uriKey;
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    abstract public function apply(Request $request, Builder $builder, mixed $value): Builder;

    /**
     * @return View|Factory
     */
    abstract protected function render(): View|Factory;

    /**
     * @param string $view
     * @return Filter
     */
    public function view(string $view): Filter
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @param string $uriKey
     * @return Filter
     */
    public function setUriKey(string $uriKey): Filter
    {
        $this->uriKey = $uriKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getUriKey(): string
    {
        return $this->uriKey;
    }

    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return static::$type;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Filter
     */
    public function label(string $label): Filter
    {
        $this->label = $label;

        return $this;
    }
}
