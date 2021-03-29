<td class="h-12 py-4 px-6 text-left whitespace-nowrap text-center absolute w-32 right-0 border-b border-l border-gray-200 hover:bg-gray-100"">
    <div class="flex item-center justify-center">
        @include("livewire-tables::edit-action")
        @if($deletable)
            @include("livewire-tables::delete-action")
        @endif
    </div>
</td>
