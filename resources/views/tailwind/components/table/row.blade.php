@props(['url' => null, 'reordering' => false])

<tr {{ $attributes}}
    @if ($url)
        onclick="window.location='{{ $url }}';"
        style="cursor:pointer"
    @endif
>
    {{ $slot }}
</tr>
