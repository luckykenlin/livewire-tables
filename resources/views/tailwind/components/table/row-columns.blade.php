@foreach($columns as $column)
    @if ($column->isVisible())

        <x-livewire-tables::table.cell
            :class="method_exists($this, 'setTableDataClass') ? $this->setTableDataClass($column, $row) : ''"
            :id="method_exists($this, 'setTableDataId') ? $this->setTableDataId($column, $row) : ''"
            :customAttributes="method_exists($this, 'setTableDataAttributes') ? $this->setTableDataAttributes($column, $row) : []"
        >

            {{$column->resolveColumn($column, $row)}}

        </x-livewire-tables::table.cell>

    @endif
@endforeach
