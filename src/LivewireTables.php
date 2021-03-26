<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

abstract class LivewireTables extends Component
{
    use WithPagination;

    protected Builder $query;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->query = $this->initialQuery();
    }

    abstract protected function query();

    abstract protected function columns();

    protected function view(): string
    {
        return 'livewire.table';
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
