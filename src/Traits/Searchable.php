<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * @var bool
     */
    public bool $showSearch = true;

    /**
     * @var bool
     */
    public bool $clearSearchButton = true;

    /**
     * @var string
     */
    public string $search = '';

    /**
     * @var int
     */
    public int $searchDebounce = 350;

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function applySearch(Builder $builder): Builder
    {
        //todo
    }

    /**
     * Reset search
     */
    public function resetSearch(): void
    {
        $this->search = '';
    }
}
