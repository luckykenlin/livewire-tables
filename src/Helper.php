<?php

namespace Luckykenlin\LivewireTables;

use Illuminate\Database\Eloquent\Builder;

class Helper
{
    /**
     * Get the table name from the builder.
     */
    public static function getTableNameFromBuilder(Builder $builder): string
    {
        return $builder->getModel()->getTable();
    }

    /**
     * Get column with table name.
     *
     * @param Builder $builder
     * @param string $column
     * @return string
     */
    public static function getTableColumn(Builder $builder, string $column): string
    {
        return sprintf(
            '%s.%s',
            // Table name
            Helper::getTableNameFromBuilder($builder),
            // Column name
            $column
        );
    }

    /**
     * Check if attribute has relationship.
     *
     * @param $attribute
     * @return bool
     */
    public static function hasRelationship($attribute): bool
    {
        return str_contains($attribute, '.');
    }
}
