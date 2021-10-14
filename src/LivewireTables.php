<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Luckykenlin\LivewireTables\Traits\NewResource;
use Luckykenlin\LivewireTables\Traits\Pagination;
use Luckykenlin\LivewireTables\Traits\Relation;
use Luckykenlin\LivewireTables\Traits\Searchable;
use Luckykenlin\LivewireTables\Traits\Sortable;

/**
 * Class LivewireTables
 * @package Luckykenlin\LivewireTables
 */
abstract class LivewireTables extends Component
{
    use Pagination, Relation, Sortable, Searchable, NewResource;

    /**
     * @var string
     */
    public string $primaryKey = 'id';

    /**
     * @var Model
     */
    public Model $model;

    /**
     * @var string
     */
    public string $table;

    /**
     * @var bool
     */
    public bool $responsive = true;

    /**
     * @var bool
     */
    public bool $debugEnabled = false;

    /**
     * @var string
     */
    public string $emptyMessage;

    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * Show query string on url.
     *
     * @var array
     */
    protected $queryString = [
        'search' => ['except' => ''],
        'sorts' => ['except' => ''],
    ];

    protected $listeners = ['delete'];

    public function __construct(?string $id = null)
    {
        parent::__construct($id);

        $this->paginationTheme = config('livewire-tables.theme') ?? 'tailwind';

        $this->emptyMessage = $this->emptyMessage ?? config('livewire-tables.empty_message') ?? 'Whoops! No results.';

        $this->builder = $this->query();

        $this->model = $this->getModel($this->builder);

        $this->table = $this->getTable($this->builder);

        $this->newResource = $this->newResource();
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
    protected function filters(): array
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
            'rows' => $this->rows()
        ]);
    }

    /**
     * Customize table ui.
     *
     * @return string
     */
    public function view(): string
    {
        return 'livewire-tables::' . config('livewire-tables.theme') . '.datatable';
    }

    /**
     * Get table data.
     *
     * @return LengthAwarePaginator|Collection
     */
    public function rows(): LengthAwarePaginator|Collection
    {
        $this->applySorting($this->builder);

        $this->applySearch($this->builder);

        if ($this->paginationEnabled) {
            return $this->builder->paginate(perPage: $this->perPage, pageName: $this->pageName());
        }

        return $this->builder->get();
    }

    /**
     * Delete an element base on its ID.
     */
    public function delete(string $id): void
    {
        $this->model->query()->findOrFail($id)->delete();
    }
}
