<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
 * Class LivewireTables.
 */
abstract class LivewireTables extends Component
{
    use NewResource;
    use Pagination;
    use Relation;
    use Sortable;
    use Searchable;
    use Filterable;
    use Deletable;
    use Refreshable;

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
        'search'  => ['except' => ''],
        'sorts'   => ['except' => ''],
        'filters' => ['except' => ''],
    ];

    public function __construct(?string $id = null)
    {
        parent::__construct($id);

        $this->emptyMessage = $this->emptyMessage ?? config('livewire-tables.empty_message', 'Whoops! No results.');

        $this->builder = $this->query();
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
            'rows'    => $this->rows(),
        ]);
    }

    /**
     * Default table ui.
     *
     * @return string
     */
    protected function view(): string
    {
        return 'livewire-tables::'.config('livewire-tables.theme').'.datatable';
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
