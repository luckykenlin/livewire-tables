@if($deletable)
    <x-livewire-tables-dialog-modal wire:model="confirmingDeletion">
        <x-slot name="title">
            {{ __('Delete Item') }}
        </x-slot>

        <x-slot name="content">
            {{ __("Are you sure? You won't be able to revert this! ") }}
        </x-slot>

        <x-slot name="footer">
            <x-livewire-tables-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-livewire-tables-secondary-button>

            <x-livewire-tables-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-livewire-tables-danger-button>
        </x-slot>
    </x-livewire-tables-dialog-modal>
@endif
