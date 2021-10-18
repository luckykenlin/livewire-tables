<?php

namespace Luckykenlin\LivewireTables\Traits;

trait Deletable
{
    /**
     * Delete an element base on its ID.
     */
    public function delete(string $primaryKey): void
    {
        $this->model->query()->where($this->primaryKey, $primaryKey)->delete();
    }
}
