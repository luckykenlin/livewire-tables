<?php

namespace Luckykenlin\LivewireTables\Traits;

trait Action
{
    public $itemKey = '';
    public $deletable = true;
    public $confirmingDeletion = false;

    public function delete()
    {
        $this->query()->whereKey($this->itemKey)->delete();
        $this->confirmingDeletion = false;
    }

    public function confirmDeletion($id)
    {
        $this->confirmingDeletion = true;
        $this->itemKey = $id;
    }
}
