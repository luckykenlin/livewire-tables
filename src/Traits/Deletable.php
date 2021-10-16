<?php

namespace Luckykenlin\LivewireTables\Traits;

trait Deletable
{
    /**
     * Delete an element base on its ID.
     */
    public function delete(string $id): void
    {
        $this->model->query()->findOrFail($id)->delete();
    }
}
