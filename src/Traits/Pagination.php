<?php

namespace Luckykenlin\LivewireTables\Traits;

use Livewire\WithPagination;

trait Pagination
{
    use WithPagination;

    /**
     * @var string
     */
    public string $paginationTheme = 'tailwind';

    /**
     * Amount of items to show per page.
     */
    public int $perPage = 25;

    /**
     * The options to limit the amount of results per page.
     *
     * @var array <int>
     */
    public array $perPageOptions = [10, 25, 50, 100];

    /**
     * Show the per page select.
     */
    public bool $showPerPage = true;
    /**
     * @var bool
     */
    public bool $showPagination = true;
    /**
     * @var bool
     */
    public bool $paginationEnabled = true;

    /**
     * https://laravel-livewire.com/docs/pagination
     * Resetting Pagination After Filtering Data.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * https://laravel-livewire.com/docs/pagination
     * Resetting Pagination After Changing the perPage.
     */
    public function updatingPerPage(): void
    {
        $this->resetPage();
    }
}
