<?php

namespace Luckykenlin\LivewireTables\Traits;

trait Deletable
{
    /**
     * Primary key for delete.
     *
     * @var string
     */
    public string $itemKey = '';

    /**
     * @var bool
     */
    public bool $confirmDelete = false;

    /**
     * Delete an element base on its ID.
     */
    public function delete(string $primaryKey): void
    {
        $this->model->query()->where($this->primaryKey, $primaryKey)->delete();
    }

    /**
     * Confirm to delete record.
     *
     * @param $id
     */
    public function confirmDeletion($id)
    {
        $this->itemKey = $id;

        $this->confirmDelete = true;
    }
}
