<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Luckykenlin\LivewireTables\Traits\Deletable;
use Luckykenlin\LivewireTables\Traits\Filterable;
use Luckykenlin\LivewireTables\Traits\NewResource;
use Luckykenlin\LivewireTables\Traits\Pagination;
use Luckykenlin\LivewireTables\Traits\Refreshable;
use Luckykenlin\LivewireTables\Traits\Relation;
use Luckykenlin\LivewireTables\Traits\Searchable;
use Luckykenlin\LivewireTables\Traits\Sortable;

/**
 * Class LivewireTables
 * @package Luckykenlin\LivewireTables
 */
abstract class LivewireTables extends Component
{
    use NewResource, Pagination, Relation, Sortable, Searchable, Filterable, Deletable, Refreshable;

    /**
     * @var string
     */
    public string $primaryKey = 'id';

    /**
     * Display a responsive table.
     *
     * @var bool
     */
    public bool $responsive = true;

    /**
     * Display a debug info.
     *
     * @var bool
     */
    public bool $debugEnabled = false;

    /**
     * Display an offline message when there is no connection.
     *
     * @var bool
     */
    public bool $offlineIndicator = true;

    /**
     * The message to show when there are no results from a search or query.
     *
     * @var string
     */
    public string $emptyMessage = '';

    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var string
     */
    protected string $table;

    /**
     * Show query string on url.
     *
     * @var array
     */
    protected $queryString = [
        'search' => ['except' => ''],
        'sorts' => ['except' => ''],
        'filters' => ['except' => ''],
    ];

    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     */
    public function boot(): void
    {
        $this->emptyMessage = $this->emptyMessage ?? config('livewire-tables.empty_message', 'Whoops! No results.');
    }

    public function booted(): void
    {
        $this->builder = $this->query();

        $this->model = $this->getModel($this->builder);

        $this->table = $this->getTable($this->builder);
    }

    /**
     * Define base table query.
     *
     * @return Builder
     */
    abstract public function query(): Builder;

    /**
     * Define table columns.
     *
     * @return array
     */
    abstract public function columns(): array;

    /**
     * Define table filter columns.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Render table.
     *
     * @return View
     */
    public function render(): View
    {
        return view($this->view(), [
            'columns' => $this->columns(),
            'rows' => $this->rows(),
        ]);
    }

    /**
     * Default table ui.
     *
     * @return string
     */
    protected function view(): string
    {
        return 'livewire-tables::' . config('livewire-tables.theme') . '.datatable';
    }

    /**
     * Get table data.
     *
     * @return LengthAwarePaginator|Collection
     */
    protected function rows(): LengthAwarePaginator|Collection
    {
        $this->applyFilter($this->builder);

        $this->applySearch($this->builder);

        $this->applySorting($this->builder);

        if ($this->paginationEnabled) {
            return $this->builder->paginate(perPage: $this->perPage, pageName: $this->pageName());
        }

        return $this->builder->get();
    }
}
