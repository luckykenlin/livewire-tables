@if($this->hasFilters())
    <div
        x-data="{ open: false }"
        x-on:keydown.escape.stop="open = false"
        x-on:mousedown.away="open = false"
        class="relative block shadow-sm md:inline-block text-left"
    >
        <div>
            <button
                type="button"
                class="inline-flex justify-center w-full rounded border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                id="filters-menu"
                x-on:click="open = !open"
                aria-haspopup="true"
                x-bind:aria-expanded="open"
                aria-expanded="true"
            >
                @lang('livewire-tables::filters.filters')

                <svg x-bind:class="open ? 'fill-current text-indigo-700' : ''" class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </button>
        </div>

        <div
            x-cloak
            x-show="open"
            x-transition
            class="origin-top-right absolute right-0 mt-2 w-full md:w-56 rounded shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50 dark:bg-gray-700 dark:text-white dark:divide-gray-600"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="filters-menu"
        >
            @foreach($this->filters() as $filter)
                {{ $filter->render() }}
            @endforeach

            @if (count($filters))
                <div class="py-1" role="none">
                    <div class="block px-4 py-2 text-sm text-gray-700 dark:text-white" role="menuitem">
                        <button
                            wire:click.prevent="resetFilters"
                            x-on:click="open = false"
                            type="button"
                            class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:hover:border-gray-500"
                        >
                            @lang('livewire-tables::filters.clear')
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endif
