<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class LivewireTables
 * @package Luckykenlin\LivewireTables
 */
abstract class LivewireTables extends Component
{
    use WithPagination;

    public string $primaryKey = 'id';
    public bool $showSearch = true;
    public bool $responsive = true;
    public bool $showPagination = true;
    public bool $paginationEnabled = true;
    public ?string $search = null;


    public string $defaultSortColumn = '';
    public string $defaultSortDirection = 'asc';


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
        'search' => ['except' => '']
    ];

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
            'rows' => $this->models(),
        ]);
    }

    /**
     * Get table data.
     *
     * @return LengthAwarePaginator
     */
    public function models(): LengthAwarePaginator
    {
        return $this->query()->paginate();
    }

    public function sortBy(string $field): ?string
    {
//        if (! isset($this->sorts[$field])) {
//            return $this->sorts[$field] = 'asc';
//        }
//
//        if ($this->sorts[$field] === 'asc') {
//            return $this->sorts[$field] = 'desc';
//        }
//
//        unset($this->sorts[$field]);
//
//        return null;
    }
}
