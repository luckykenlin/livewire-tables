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
## Documentation
[https://luckykenlin.github.io/livewire-tables/](https://luckykenlin.github.io/livewire-tables/)

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
use Luckykenlin\LivewireTables\Views\Action;
use Luckykenlin\LivewireTables\Views\Column;
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
            Column::make('#', 'id')->sortable(),
            Column::make('Name', 'name')->searchable()->sortable(),
            Column::make('Email', 'email')->searchable()->sortable(),

            Action::make()
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

## Rendering the Table

Place the following where you want the table to appear.

`<livewire:users-table />`


## To-do/Roadmap

- [ ] User Column Selection
- [ ] Bulk Actions
- [ ] Date Filter
- [ ] Selector Filter
- [ ] Multiple Selector Filter
- [ ] Bulk Actions
- [ ] CDN Css
- [ ] Test Suite

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
