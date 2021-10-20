<div class="w-full shadow-sm md:w-auto ml-0 md:ml-2">
    <select
        wire:model="perPage"
        id="perPage"
        class="block w-full border-gray-300 rounded shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600"
    >
        @foreach ($perPageOptions as $item)
            <option value="{{ $item }}">{{ $item === -1 ? __('All') : $item }}</option>
        @endforeach
    </select>
</div>
