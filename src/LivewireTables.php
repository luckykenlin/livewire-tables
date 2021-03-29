<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Livewire\Component;
use Luckykenlin\LivewireTables\Traits\Action;
use Luckykenlin\LivewireTables\Traits\Export;
use Luckykenlin\LivewireTables\Traits\Filter;
use Luckykenlin\LivewireTables\Traits\Helper;
use Luckykenlin\LivewireTables\Traits\Pagination;
use Luckykenlin\LivewireTables\Traits\Search;
use Luckykenlin\LivewireTables\Traits\Sort;

abstract class LivewireTables extends Component
{
    use Pagination;
    use Filter;
    use Search;
    use Action;
    use Sort;
    use Export;
    use Helper;

    protected $query;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sort' => ['except' => ''],
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->query = $this->initialQuery();
    }

    abstract protected function query();

    abstract protected function columns();

    protected function view()
    {
        return 'livewire-tables::table';
    }

    public function render()
    {
        return view($this->view(), [
            'columns' => $this->columns(),
            'rows' => $this->models(),
        ]);
    }

    protected function models()
    {
        $this->addSearch()->addSort();

        return $this->query->paginate($this->perPage);
    }

    public function columnValue($row, $column)
    {
        if ($column->isFormatted()) {
            return app()->call($column->formatCallback, ['value' => Arr::get($row->toArray(), $column->attribute)]);
        }

        return Arr::get($row->toArray(), $column->attribute);
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
