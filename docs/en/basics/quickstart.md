# Quick start

> At the very least, you need to give the table component a list of `columns` and a base `query` to start with:

## Basic Example
To create a table component you may draw inspiration from the below stub:

```bash
php artisan make:table UsersTable
```

To specific model use --model:

```bash
php artisan make:table UsersTable --model=User
```

A simple example:
> You will find this file `UsersTable` in the folder `app\Http\Livewire`.

```php
<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Luckykenlin\LivewireTables\LivewireTables;
use Luckykenlin\LivewireTables\Views\Action;
use Luckykenlin\LivewireTables\Views\Column;

class UserTable extends LivewireTables
{
    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')->sortable(),
            Column::make('Avatar', 'id')->render(fn(User $user) => view('users.avatar')),
            Column::make('Name')->sortable()->searchable(),

            Action::make()
        ];
    }
```

!> Your component must implement two methods:

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
## Route

Now you need to create a route for this table:

```php
Route::view('/users', 'dashboard.users-table')->name('dashboard.users');
```

Of course, you can do this from a `Controller`.

## Blade Component

In the view, you will need to call the `Livewire Component`:

```html
<livewire:users-table /> 
```

If you are testing the abobe example, remember that you need to create the view: `profile.avatar`, because is rendering directly from the `Table Component`:

```php 
Column::make('Avatar', 'profile.profile_avatar')
    ->searchable()
    ->sortable()
    ->render(function(User $user) {
        return view('profile.avatar', compact('user'));
    })
```

And this is the result:
