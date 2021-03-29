<td class="py-3 px-6 text-left whitespace-nowrap text-center">
    @if($this->columnValue($row, $column))
        <span class="text-sm font-medium bg-green-100 px-3 py-1 rounded text-green-500 align-middle"
              title="">
              {{$column->trueValue}}
        </span>
    @else
        <span class="text-sm font-medium bg-red-100 px-3 py-1 rounded text-red-500 align-middle"
              title="">
              {{$column->falseValue}}
        </span>
    @endif
</td>
