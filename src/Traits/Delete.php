<?php

namespace Luckykenlin\LivewireTables\Traits;

/**
 * Trait Delete
 * @package Luckykenlin\LivewireTables\Traits
 */
trait Delete
{
    /**
     * Primary key for delete.
     *
     * @var string
     */
    public $itemKey = '';

    /**
     * Determine delete action to show.
     *
     * @var bool
     */
    public $deletable = true;

    /**
     * Determine confirm modal to delete.
     *
     * @var bool
     */
    public $confirmDeletable = true;

    /**
     * Determine confirm modal to show.
     *
     * @var bool
     */
    public $confirmingDeletion = false;

    /**
     * Delete record.
     */
    public function delete()
    {
        $this->query()->whereKey($this->itemKey)->delete();
        $this->confirmingDeletion = false;
    }

    /**
     * Confirm to delete record.
     *
     * @param $id
     */
    public function confirmDeletion($id)
    {
        $this->itemKey = $id;

        if ($this->confirmDeletable) {
            $this->confirmingDeletion = true;
        } else {
            $this->delete();
        }
    }
}
