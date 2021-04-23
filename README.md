# livewire-tables

[![Latest Version on Packagist](https://img.shields.io/packagist/v/luckykenlin/livewire-tables.svg?style=flat-square)](https://packagist.org/packages/luckykenlin/livewire-tables)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/luckykenlin/livewire-tables/run-tests?label=tests)](https://github.com/luckykenlin/livewire-tables/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/luckykenlin/livewire-tables/Check%20&%20fix%20styling?label=code%20style)](https://github.com/luckykenlin/livewire-tables/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/luckykenlin/livewire-tables.svg?style=flat-square)](https://packagist.org/packages/luckykenlin/livewire-tables)


A dynamic table component for Laravel Livewire.

## Requirements
- [Laravel](https://laravel.com/docs)
- [Livewire](https://laravel-livewire.com/docs)
- [TailwindCSS](https://tailwindcss.com/docs)

## Installation

You can install the package via composer:

```bash
composer require luckykenlin/livewire-tables
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Luckykenlin\LivewireTables\LivewireTablesServiceProvider" --tag="livewire-tables-config"
```

This is the contents of the published config file:

```php
return [
];
```
You can publish the views file with:
```bash
php artisan vendor:publish --provider="Luckykenlin\LivewireTables\LivewireTablesServiceProvider" --tag="livewire-tables-views"
```
### Using this package in a Laravel project
You can easily use this packge in a local Laravel project, after cloning:

1. Specify a new repository in your composer.json file of the Laravel project (not this package!):
```
// composer.json

{
  "repositories": [
    {
      "type": "path",
      "url": "../../livewire-tables" // the relative path to your package
    }
  ]
}
```

2. Require the package in the local Laravel project:
``` 
composer require luckykenlin/livewire-tables
```

## Usage

### Creating Tables

To create a table component you draw inspiration from the below stub:

```php
<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Luckykenlin\LivewireTables\Columns\Action;
use Luckykenlin\LivewireTables\Columns\Column;
use Luckykenlin\LivewireTables\Columns\ID;
use Luckykenlin\LivewireTables\LivewireTables;

class UsersTable extends LivewireTables
{
    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            ID::make()->sortable()->label("#"),
            Column::make('Name', 'name')->searchable()->sortable(),
            Column::make('Email', 'email')->searchable()->sortable(),

            Action::make()->view("livewire-tables::table-actions")
        ];
    }
}

```

Your component must implement two methods:

```php
/**
 * This defines the start of the query, usually Model::query() but can also eager load relationships and counts if needed.
 */
public function query() : Builder;

/**
 * This defines the columns of the table, they don't necessarily have to map to columns on the database table.
 */
public function columns() : array;
```

### Rendering the Table

Place the following where you want the table to appear.

`<livewire:users-table />`

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ken Lin](https://github.com/KenLin)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
