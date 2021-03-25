<?php

namespace Luckykenlin\LivewireTables\Traits;

use Livewire\WithPagination;

trait Pagination
{
    use WithPagination;

    public bool $paginate = true;
    public int $perPage = 10;

    public function paginationView()
    {
        return "livewire.pagination";
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }
}
