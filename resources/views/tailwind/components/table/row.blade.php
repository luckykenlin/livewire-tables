@props(['clickable' => false, 'row'=> null, 'customAttributes' => []])

<tr {{ $attributes->merge($customAttributes) }}
    @if($clickable)
        wire:click="rowOnClick({{$row}})"
        style="cursor: pointer"
    @endif
>
    {{ $slot }}
</tr>
