# livewire-tables

[![Latest Version on Packagist](https://img.shields.io/packagist/v/luckykenlin/livewire-tables.svg?style=flat-square)](https://packagist.org/packages/luckykenlin/livewire-tables)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/luckykenlin/livewire-tables/run-tests?label=tests)](https://github.com/luckykenlin/livewire-tables/actions?query=workflow%3ATests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/luckykenlin/livewire-tables.svg?style=flat-square)](https://packagist.org/packages/luckykenlin/livewire-tables)


A dynamic livewire table component for laravel.

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
```bash
php artisan make:table UsersTable
```

To specific model use --model:
```bash
php artisan make:table UsersTable --model=User
```

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

### Column Methods
| Method | Arguments | Result | Example |
|----|----|----|----|
|**label**|*String* $name|Changes the display name of a column|```Column::name('id')->label('ID)```|
|**format**|[*Callback* $format]| Format display as callback function |```Column::name('price')->format(function($value) => { return '$'.$value}),```|
|**hideOnTable**| |Marks column to start as hidden|```Column::name('id')->hideOnTable()```|
|**sortable**| |Marks column can be sorted|```Column::name('dob')->sortable(),```|
|**searchable**| |Includes the column in the global search|```Column::name('name')->searchable()```|
|**filterable**| |Adds a filter to the column, according to Column type|```Column::name('status')->filterable()```|
|**view**|*String* $viewName| customize column render view | ```Column::name('status')->view('vendoer.livewire-tables.boolean.blade.php')```|

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
