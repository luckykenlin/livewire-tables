<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Luckykenlin\LivewireTables\Views\Column;

trait Searchable
{
    /**
     * Show search box.
     *
     * @var bool
     */
    public bool $showSearch = true;

    /**
     * Show clear search button.
     *
     * @var bool
     */
    public bool $clearSearchButton = true;

    /**
     * Search text.
     *
     * @var string
     */
    public string $search = '';

    /**
     * Search model debounce.
     *
     * @var int
     */
    public int $searchDebounce = 350;

    /**
     * Trick of search.
     *
     * @param Builder $builder
     * @return Builder
     */
    protected function applySearch(Builder $builder): Builder
    {
        if (trim($this->search) === '' || ! $this->showSearch) {
            return $builder;
        }

        $builder->where(function ($builder) {
            collect($this->columns())
                ->reject(fn ($column) => ! $column->isSearchable())
                ->each(function (Column $column) use ($builder) {
                    // If the column has a search callback, just use that
                    if ($column->hasSearchCallback()) {
                        // Call the callback
                        ($column->getSearchCallback())($builder, trim($this->search));

                    // Search for relation
                    } elseif ($column->hasRelationship()) {
                        // Get relation of column
                        $relationship = $this->relationship($column->attribute);

                        // Search using or whereHas
                        $builder->orWhereHas($relationship->name, function (Builder $builder) use ($relationship) {
                            $builder->where($relationship->attribute, 'like', $this->searchString());
                        });

                    //  Only search the column.
                    } else {
                        $builder->orWhere($this->getColumnAttribute($builder, $column), 'like', $this->searchString());
                    }
                });
        });

        return $builder;
    }

    /**
     * Set the search string.
     */
    private function searchString(): string
    {
        return $this->search ? '%' . trim($this->search) . '%' : '';
    }

    /**
     * Reset search.
     */
    public function resetSearch(): void
    {
        $this->search = '';
    }
}
