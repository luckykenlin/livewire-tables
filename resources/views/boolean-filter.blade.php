<div class="space-y-2">
    <label for="">{{$column->name}}</label>
    <select wire:model="{{"booleanFilters.$column->attribute"}}"
            class="w-full bg-white h-10 px-5 pr-16 text-sm rounded-md border-2 border-gray-300 focus:outline-none focus:ring-0 focus:ring-gray-600 focus:border-gray-600">
        <option value="">All</option>
        <option value="1">{{$column->trueValue}}</option>
        <option value="0">{{$column->falseValue}}</option>
    </select>
</div>
