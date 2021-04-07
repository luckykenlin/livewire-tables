<?php

namespace Luckykenlin\LivewireTables;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Luckykenlin\LivewireTables\Traits\Delete;
use Luckykenlin\LivewireTables\Traits\Export;
use Luckykenlin\LivewireTables\Traits\Filter;
use Luckykenlin\LivewireTables\Traits\Helper;
use Luckykenlin\LivewireTables\Traits\Pagination;
use Luckykenlin\LivewireTables\Traits\Search;
use Luckykenlin\LivewireTables\Traits\Sort;

/**
 * Class LivewireTables
 * @package Luckykenlin\LivewireTables
 */
abstract class LivewireTables extends Component
{
    use Pagination;
    use Filter;
    use Search;
    use Sort;
    use Export;
    use Delete;
    use Helper;

    /**
     * @var Builder
     */
    protected $query;

    /**
     * Show query string on url.
     *
     * @var array
     */
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    /**
     * LivewireTables constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->query = $this->initialQuery();
        $this->initFilter();
    }

    /**
     * Define base table query.
     *
     * @return Builder
     */
    abstract protected function query(): Builder;

    /**
     * Define table columns.
     *
     * @return array
     */
    abstract protected function columns(): array;

    /**
     * Define table filter columns.
     *
     * @return array
     */
//   abstract protected function filters(): array;

    /**
     * Customize table ui.
     *
     * @return string
     */
    protected function view()
    {
        return 'livewire-tables::table';
    }

    /**
     * Render table.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view($this->view(), [
            'columns' => $this->columns(),
            'rows' => $this->models(),
        ]);
    }

    /**
     * Get table data.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function models()
    {
        $this->addFilter()->addSearch()->addSort();

        return $this->query->paginate($this->perPage);
    }

    /**
     * Get column value.
     *
     * @param $row
     * @param $column
     * @return array|\ArrayAccess|mixed
     */
    public function columnValue($row, $column)
    {
        if ($column->isFormatted()) {
            return app()->call($column->formatCallback, ['value' => Arr::get($row->toArray(), $column->attribute)]);
        }

        return Arr::get($row->toArray(), Str::snake($column->attribute));
    }

    /**
     * Initial query and avoid sql ambiguous column name via join connection.
     *
     * @return Builder
     */
    private function initialQuery()
    {
        return $this->query()->select("{$this->getTable($this->query())}.*");
    }
}
