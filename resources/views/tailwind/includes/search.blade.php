<div class="flex rounded shadow-sm relative">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <!-- icon: heroicon-s-search -->
        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"/>
        </svg>
    </div>
    <input
        wire:model.debounce.{{$searchDebounce}}ms="search"
        placeholder="@lang('livewire-tables::strings.search')"
        type="text"
        class="block px-10 w-full border-gray-300 rounded shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 @if (isset($search) && strlen($search)) rounded-l-md rounded-r-none focus:ring-0 focus:border-gray-300 @else focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded @endif"
    />

    @if (trim($search) && $clearSearchButton)
        <span wire:click="resetSearch"
              class="inline-flex items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
        </span>
    @endif
</div>
