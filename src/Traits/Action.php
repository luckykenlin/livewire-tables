<?php

namespace Luckykenlin\LivewireTables\Traits;

trait Action
{
    public string $itemKey = '';
    public bool $deletable = true;
    public bool $confirmingDeletion = false;

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
