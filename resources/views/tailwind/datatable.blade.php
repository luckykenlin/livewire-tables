<div>
    <div>
        <div class="flex-col">
            <div class="space-y-4">
                @includeWhen($debugEnabled, 'livewire-tables::tailwind.includes.debug')
                <div class="md:flex md:justify-between px-6 py-2 md:p-0">
                    <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2">
                        @include('livewire-tables::tailwind.includes.search')
                    </div>

                    <div class="md:flex md:items-center">
{{--                        <div>@include('livewire-tables::tailwind.includes.bulk-actions')</div>--}}
{{--                        <div>@include('livewire-tables::tailwind.includes.column-select')</div>--}}
{{--                        <div>@include('livewire-tables::tailwind.includes.per-page')</div>--}}
                    </div>
                </div>

                @include('livewire-tables::tailwind.includes.table')
                @include('livewire-tables::tailwind.includes.pagination')
            </div>
        </div>
    </div>
</div>
