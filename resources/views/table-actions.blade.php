<td class="h-12 py-4 px-6 text-left whitespace-nowrap text-center absolute w-32 right-0 border-b border-l border-gray-200 hover:bg-gray-100">
    <div class="flex item-center justify-center">

        {{--    example edit icon with link  --}}
        {{--    <x-livewire-tables-edit-action :url="route('users.edit', [$row->id])"/> --}}

        @if($deletable)
            <x-livewire-tables-delete-action wire:click="confirmDeletion({{$row->id}})"/>
        @endif
    </div>
</td>
