<div class="bg-white shadow-lg">
    <div class="overflow-x-auto px-6 sm:px-0">
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
            <div class="w-full">
                <div class="grid grid-cols-4 gap-2  px-4 mt-4 items-end">
                    @if($searchable)
                        <x-livewire-tables-search-bar placeholder="{{$searchPlaceholder}}" wire:model="search"/>
                    @endif
                    @foreach($columns as $index => $column)
                        @if($column->canFilter())
                            <x-dynamic-component :component="$column->component" :column="$column"/>
                        @endif
                    @endforeach
                </div>
                <div class="bg-white rounded my-6 relative">
                    <div class="overflow-x-scroll mr-32">
                        <table class="min-w-max w-full table-auto whitespace-nowrap" wire:loading.class="opacity-50">
                            <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                @foreach($columns as $column)
                                    @if($column->sortable)
                                        <th class="px-6 py-3" wire:click="sort('{{$column->attribute}}')">
                                            <div class="flex justify-start items-center space-x-1">
                                                <span>{{$column->name}}</span>
                                                @if($column->attribute === $sort)
                                                    @if($this->direction === "asc")
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg"
                                                             viewBox="0 0 20 20"
                                                             fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                  d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                                                                  clip-rule="evenodd"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-3 h-3 text-primary"
                                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                             fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                  d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                                                                  clip-rule="evenodd"/>
                                                        </svg>
                                                    @endif
                                                @endif
                                            </div>
                                        </th>
                                    @else
                                        <th class="px-6 py-3 {{$column->type === "action"? "absolute w-32 right-0 bg-gray-100 text-gray-600 uppercase text-sml" : ""}}">
                                            <div class="flex justify-start items-center space-x-1">
                                                <span>{{$column->name}}</span>
                                            </div>
                                        </th>
                                    @endif
                                @endforeach
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($rows as $row)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    @foreach($columns as $column)
                                        @if($column->view)
                                            @include($column->view)
                                        @else
                                            <td class="h-12 py-3 px-6 text-left">
                                                <span>{{$this->columnValue($row, $column)}}</span>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @empty
                                <tr class="border-b border-gray-200">
                                    <td class="text-center py-10" colspan="99">
                                    <span class="text-2xl font-semibold text-gray-400 tracking-widest">
                                        {{ __('No results to display.') }}
                                    </span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($paginate)
                        <div class="p-3">
                            {{$rows->onEachSide(1)->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include("livewire-tables::modals")
    </div>
</div>
