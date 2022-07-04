<x-livewire-tables::table
    :class="method_exists($this, 'setTableClass') ? ' ' . $this->setTableClass() : '' "
>
    <x-slot name="head">

        @foreach($columns as $column)
            @if ($column->isVisible())
                @if ($column->isBlank())
                    <x-livewire-tables::table.heading/>
                @else
                    <x-livewire-tables::table.heading
                        :attribute="$column->getAttribute()"
                        :sortingEnabled="$sortingEnabled"
                        :sortable="$column->isSortable()"
                        :field="$column->getField()"
                        :direction="$column->getField() ? $sorts[$column->getField()] ?? null : null"
                        :class="$column->class() ?? ''"
                        :customAttributes="$column->attributes()"
                    />
                @endif
            @endif
        @endforeach

    </x-slot>

    <x-slot name="body">
        @forelse ($rows as $index => $row)
            <x-livewire-tables::table.row
                wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
                wire:key="table-row-{{ $row->{$primaryKey} }}"
                :clickable="method_exists($this, 'rowOnClick')"
                :row="$row"
                :class="
                    ($index % 2 === 0 ?
                    'bg-white dark:bg-gray-700 dark:text-white' . (method_exists($this, 'rowOnClick') ? 'hover:bg-gray-100' : '') :
                    'bg-gray-50 dark:bg-gray-800 dark:text-white') .
                    (method_exists($this, 'rowOnClick') ? ' hover:bg-gray-100 dark:hover:bg-gray-900 transition' : '') .
                    (method_exists($this, 'setTableRowClass') ? ' ' . $this->setTableRowClass($row) : '')
                "
                :id="method_exists($this, 'setTableRowId') ? $this->setTableRowId($row) : ''"
                :customAttributes="method_exists($this, 'setTableRowAttributes') ? $this->setTableRowAttributes($row) : []"
            >
                @include('livewire-tables::tailwind.components.table.row-columns')
            </x-livewire-tables::table.row>
        @empty
            <x-livewire-tables::table.row>
                <x-livewire-tables::table.cell
                    :colspan="count($columns)"
                    :responsive="$this->responsive"
                    class="dark:bg-gray-800"
                >
                    <div class="flex justify-center items-center space-x-2 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>

                        <span class="font-medium py-8 text-gray-400 text-xl dark:text-white">@lang($emptyMessage)</span>
                    </div>
                </x-livewire-tables::table.cell>
            </x-livewire-tables::table.row>
        @endforelse

    </x-slot>
</x-livewire-tables::table>
