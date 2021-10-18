<?php

namespace Luckykenlin\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Luckykenlin\LivewireTables\Views\Column;

trait Relation
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var string
     */
    protected string $table;

    /**
     * Initialize
     */
    protected function initializeRelation()
    {
        $this->model = $this->getModel($this->builder);

        $this->table = $this->getTable($this->builder);
    }

    /**
     * Get column by field.
     *
     * @param string $field
     * @return mixed
     */
    protected function getColumn(string $field): mixed
    {
        return collect($this->columns())
            ->where('field', $field)
            ->first();
    }

    /**
     * Get model instance by query builder.
     *
     * @param $query
     * @return Model
     */
    protected function getModel($query): Model
    {
        return $query->getModel();
    }

    /**
     * Get table by query builder.
     *
     * @param $query
     * @return string
     */
    protected function getTable($query): string
    {
        return $this->getModel($query)->getTable();
    }

    /**
     * Set the column attribute.
     */
    protected function getColumnAttribute(Builder $builder, Column $column): string
    {
        $table = $this->getTable($builder);
        $attribute = $column->getAttribute();

        return sprintf('%s.%s', $table, $attribute);
    }

    /**
     * Get relation by attribute.
     *
     * @param $attribute
     * @return object
     */
    public function relationship($attribute): object
    {
        $parts = explode('.', $attribute);

        return (object)[
            'attribute' => array_pop($parts),
            'name' => implode('.', $parts),
        ];
    }

    /**
     * Set attribute.
     *
     * @param $query
     * @param $relationships
     * @param $attribute
     * @return string
     */
    public function attribute($query, $relationships, $attribute): string
    {
        $table = '';
        $last_query = $query;

        foreach (explode('.', $relationships) as $each_relationship) {
            $model = $last_query->getRelation($each_relationship);

            switch (true) {
                case $model instanceof BelongsToMany:
                    $pivot = $model->getTable();
                    $pivotPK = $model->getExistenceCompareKey();
                    $pivotFK = $model->getQualifiedParentKeyName();
                    $query->leftJoin($pivot, $pivotPK, $pivotFK);

                    $related = $model->getRelated();
                    $table = $related->getTable();
                    $tablePK = $related->getForeignKey();
                    $foreign = $pivot . '.' . $tablePK;
                    $other = $related->getQualifiedKeyName();

                    $last_query->addSelect($table . '.' . $attribute);
                    $query->leftJoin($table, $foreign, $other);

                    break;

                case $model instanceof HasOneOrMany:
                    $table = $model->getRelated()->getTable();
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedParentKeyName();

                    break;

                case $model instanceof BelongsTo:
                    $table = $model->getRelated()->getTable();
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedOwnerKeyName();

                    break;

                default:
                    return sprintf('%s.%s', $table, $attribute);
            }

            $query->leftJoin($table, $foreign, $other);
            $last_query = $model->getQuery();
        }

        return sprintf('%s.%s', $table, $attribute);
    }
}
