# Installation

!> Note: This package assumes you already have `Laravel Livewire 2.x` and `Alpine.js 2.x` installed.

You can install the package via `composer`:

```bash
composer require luckykenlin/livewire-tables
```

!> Publishing assets are optional unless you want to customize this package.

```bash
php artisan vendor:publish --provider="Luckykenlin\LivewireTables\LivewireTablesServiceProvider" --tag=livewire-tables-config

php artisan vendor:publish --provider="Luckykenlin\LivewireTables\LivewireTablesServiceProvider" --tag=livewire-tables-views

php artisan vendor:publish --provider="Luckykenlin\LivewireTables\LivewireTablesServiceProvider" --tag=livewire-tables-translations
```

### Tailwind Purge

If you find that Tailwind's CSS purge is removing styles that are needed, you have to tell Tailwind to look for the table styles so it knows not to purge them.

In your `tailwind.config.js` purge configuration

```javascript
module.exports = {
    mode: 'jit',
    purge: [
        ...
        './app/Http/Livewire/**/*.php',
        './vendor/luckykenlin/livewire-tables/**/*.blade.php'
    ],
    ...
};
```


### Livewire Assets

Add the following Blade directives in the head tag, and before the end body tag in your template.

```html
<html>
<head>
    ...
    @livewireStyles
</head>
<body>
    ...
    @livewireScripts
</body>
</html>
```

You can alternatively use the tag syntax.

```html
<livewire:styles />
...
<livewire:scripts />
```

That's it! That's all you need to start using Livewire Tables.

### Using this package in a Laravel project if you want to test...

You can easily use this packge in a local Laravel project, after cloning:

1. Specify a new repository in your `composer.json` file of the Laravel project (not this package!):

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../../livewire-tables", // the relative path to your package
      "canonical": false
    }
  ]
}
```

2. Require the package in the local Laravel project:

```bash
composer require luckykenlin/livewire-tables
```



