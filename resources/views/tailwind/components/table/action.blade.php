<div class="flex justify-start text-gray-400 -ml-1">
    @unless($hideShowButton)
        <!-- Show button -->
        <a
            href="{{ sprintf('%s/%s', $row->getTable(), $row->id) }}"
            class="py-2 px-1 hover:text-green-600"
        >
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
        </a>
    @endunless

    @unless($hideEditButton)
        <!-- Edit button -->
        <a
            href="{{ sprintf('%s/%s', $row->getTable(), $row->id) }}/edit"
            class="py-2 px-1 hover:text-blue-600"
        >
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>
    @endunless

    @unless($hideDeleteButton)
        <!-- Delete button -->
        <livewire:delete-button :itemId="$row->id" :key="time().$row->id"/>
    @endunless
</div>
