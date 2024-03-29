# Requirements
PHP ^8.1 | ^8.2
Laravel ^9.0 | ^10.0
Laravel Livewire ^3.0
- `PHP ^8.1 | ^8.2`
- `Laravel ^9.0 | ^10.0`
- `Laravel Livewire ^3.0`
- `AlpineJS ^3.0`
- `Tailwind Css ^2.0 | ^3.0`
`

Since Livewire V3 auto injected assets feature, no need to do anything.

For Livewire v2 example:

```html 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Livewire styles -->
        <livewire:styles />

        <!-- TailwindCSS styles -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

        <!-- AlpineJS javascript -->
        <script src="//cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    </head>
    <body>
        <!-- Livewire scripts -->
        <livewire:scripts />
    </body>
</html>

```
Or you can be compiling the dependencies using **Laravel mix**...
