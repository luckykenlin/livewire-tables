<div>
    <div
        class="relative"
        @if ($refresh)
        @if ($refreshInSeconds)
        wire:poll.{{ $refreshInSeconds * 1000 }}ms
        @else
        wire:poll
        @endif
        @endif
    >
        <div class="flex-col">
            @include('livewire-tables::tailwind.includes.sorting-pills')
            @include('livewire-tables::tailwind.includes.filter-pills')
            <div class="">
                @includeWhen($debugEnabled,'livewire-tables::tailwind.includes.debug')
                @includeWhen($offlineIndicator,'livewire-tables::tailwind.includes.offline')
                <div class="md:flex md:justify-between mb-6">
                    <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2">
                        @includeWhen($showSearch,'livewire-tables::tailwind.includes.search')
                        @includeWhen($showFilters, 'livewire-tables::tailwind.includes.filters')
                    </div>

                    <div class="md:flex md:items-center space-y-4 md:space-y-0">
                        {{--                        <div>@include('livewire-tables::tailwind.includes.bulk-actions')</div>--}}
                        {{--                        <div>@include('livewire-tables::tailwind.includes.column-select')</div>--}}
                        <div>@includeWhen($paginationEnabled && $showPerPage,'livewire-tables::tailwind.includes.per-page')</div>
                        <div class="flex justify-end">
                            @includeWhen($this->hasNewResource(),'livewire-tables::tailwind.includes.new-resource')
                        </div>
                    </div>
                </div>

                @include('livewire-tables::tailwind.includes.table')
                @includeWhen($showPagination,'livewire-tables::tailwind.includes.pagination')
            </div>
        </div>
    </div>

    <x-livewire-tables::modals.delete-button-modal wire:model.defer="confirmDelete" :itemKey="$itemKey"/>
</div>
