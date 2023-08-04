<?php

namespace Luckykenlin\LivewireTables\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteModel extends Component
{
    /**
     * @var string
     */
    public string $itemId;

    /**
     * @param $itemId
     */
    public function mount($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return View|Factory
     */
    public function render(): View|Factory
    {
        return view('livewire-tables::' . config('livewire-tables.theme') . '.includes.delete-button');
    }

    /**
     * Delete elements from ID or List of IDs.
     */
    public function delete(?string $id = null): void
    {
        $this->dispatch('delete', $id);
    }
}
