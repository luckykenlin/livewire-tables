<?php

namespace Luckykenlin\LivewireTables;

use Livewire\Component;

class DeleteComponent extends Component
{
    public string $itemId;

    public function mount($itemId)
    {
        $this->itemId = $itemId;
    }

    public function render()
    {
        return view('livewire-tables::' . config('livewire-tables.theme') . '.includes.delete-button');
    }

    /**
     * Delete elements from ID or List of IDs.
     */
    public function delete(?string $id = null): void
    {
        $this->emit('delete', $id);
    }
}
