<?php

namespace Luckykenlin\LivewireTables\Traits;

use Livewire\WithPagination;

/**
 * Trait Pagination
 * @package Luckykenlin\LivewireTables\Traits
 */
trait Pagination
{
    use WithPagination;

    /**
     * @var bool
     */
    public $paginate = true;
    /**
     * @var int
     */
    public $perPage = 10;

    /**
     * Customize ui.
     *
     * @return string
     */
    public function paginationView()
    {
        return "livewire-tables::pagination";
    }

    /**
     * Reset page hook when update search.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Reset page hook when update per page.
     */
    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
