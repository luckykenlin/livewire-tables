<div class="block text-sm text-gray-700" role="menuitem">
    <label for="filter-{{ $uriKey }}"
           class="block py-2 px-4 font-semibold leading-5 text-gray-700 dark:text-white bg-indigo-100">
        {{$name }}
    </label>

    <div class="px-4 py-3 relative shadow-sm">
        <x-livewire-tables::form.select
            wire:model.stop="filterValues.{{ $uriKey }}"
            wire:key="{{\Illuminate\Support\Str::random()}}"
            id="filter-{{ $uriKey }}"
        >
            @foreach($options as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </x-livewire-tables::form.select>
    </div>
</div>