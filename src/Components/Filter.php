<?php

namespace Luckykenlin\LivewireTables\Components;

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
    protected ?string $uriKey = '';

    /**
     * Front render view.
     *
     * @var string
     */
    protected string $view;

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
     * @return View
     */
    abstract protected function render(): View;

    /**
     * @param string $view
     * @return Filter
     */
    public function view(string $view): static
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @param string $uriKey
     * @return Filter
     */
    public function setUriKey(string $uriKey): static
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
}
