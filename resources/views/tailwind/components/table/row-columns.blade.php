@foreach($columns as $column)
    @if ($column->isVisible())

        <x-livewire-tables::table.cell
            :class="method_exists($this, 'setTableCellClass') ? $this->setTableCellClass($column, $row) : ''"
            :id="method_exists($this, 'setTableCellId') ? $this->setTableCellId($column, $row) : ''"
            :customAttributes="method_exists($this, 'setTableCellAttributes') ? $this->setTableCellAttributes($column, $row) : []"
            :columnClass="$column->class()"
            :responsive="$this->responsive"
        >

            @if ($column->isHtml())

                {{ new \Illuminate\Support\HtmlString($column->resolveColumn($column, $row)) }}

            @else

                {{$column->resolveColumn($column, $row)}}

            @endif

        </x-livewire-tables::table.cell>

    @endif
@endforeach
