@props(['clickable' => false, 'row'=> null])

<tr {{ $attributes}}
    @if($clickable)
        wire:click="rowOnClick({{$row}})"
        style="cursor: pointer"
    @endif
>
    {{ $slot }}
</tr>
