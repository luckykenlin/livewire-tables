<?php

namespace Luckykenlin\LivewireTables\Traits;

use Livewire\WithPagination;

trait Pagination
{
    use WithPagination;

    /**
     * Theme of pagination.
     */
    public ?string $paginationTheme;

    /**
     * Amount of items to show per page.
     */
    public int $perPage;

    /**
     * The options to limit the amount of results per page.
     */
    public array $perPageOptions;

    /**
     * Show the per page select.
     *
     * @var bool
     */
    public bool $showPerPage = true;

    /**
     * Show pagination.
     *
     * @var bool
     */
    public bool $showPagination = true;

    /**
     * Enable pagination.
     *
     * @var bool
     */
    public bool $paginationEnabled = true;

    /**
     * Initialize
     */
    public function initializePagination(): void
    {
        $this->paginationTheme = $this->paginationTheme ?? config('livewire-tables.tailwind', 'tailwind');

        $this->perPage = $this->perPage ?? config('livewire-tables.per_page', 10);

        $this->perPageOptions = $this->perPageOptions ?? config('livewire-tables.per_page_options', [10, 25, 50, 100]);
    }

    /**
     * Resolve page name for multiple component present.
     *
     * @return string
     */
    public function pageName(): string
    {
        return 'page';
    }

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
