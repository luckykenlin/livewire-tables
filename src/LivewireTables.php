<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Luckykenlin\LivewireTables\Traits\Pagination;
use Luckykenlin\LivewireTables\Traits\Searchable;
use Luckykenlin\LivewireTables\Traits\Sortable;

/**
 * Class LivewireTables
 * @package Luckykenlin\LivewireTables
 */
abstract class LivewireTables extends Component
{
    use Pagination;
    use Sortable;
    use Searchable;

    public string $primaryKey = 'id';
    public bool $responsive = true;

    protected Builder $builder;

    public bool $debugEnabled = false;

    /**
     * @var Builder
     */
    protected Builder $query;

    /**
     * Show query string on url.
     *
     * @var array
     */
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function __construct(?string $id = null)
    {
        parent::__construct($id);

        $this->paginationTheme = config('livewire-tables.theme');

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
    protected function filters(): array
    {
        return [];
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
     * Get table data.
     *
     * @return LengthAwarePaginator|Collection
     */
    public function rows(): LengthAwarePaginator|Collection
    {
        $this->applySorting($this->builder);

        if ($this->paginationEnabled) {
            return $this->builder->paginate($this->perPage);
        }

        return $this->builder->get();
    }


    /**
     * Get a column object by its field
     *
     * @param string $field
     * @return mixed
     */
    protected function getColumn(string $field): mixed
    {
        return collect($this->columns())
            ->where('field', $field)
            ->first();
    }
}
