<?php

namespace Luckykenlin\LivewireTables\Traits;

use Livewire\WithPagination;

trait Pagination
{
    use WithPagination;

    public $paginate = true;
    public $perPage = 10;

    public function paginationView()
    {
        return "livewire-tables::pagination";
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
