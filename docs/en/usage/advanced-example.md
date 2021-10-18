# Advanced Example

There will be sections of the wiki to go into these in detail, but this is an example of a table with a custom row, filters, search, custom view:

```php
<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;
use Luckykenlin\LivewireTables\Components\BooleanFilter;
use Luckykenlin\LivewireTables\LivewireTables;
use Luckykenlin\LivewireTables\Views\Action;
use Luckykenlin\LivewireTables\Views\Boolean;
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
            
            // custom view
            Column::make('Status')->render(fn(User $user) => view('users.status', ['user'=>$user])),
            Column::make('Avatar')->render(fn(User $user) => view('users.avatar', ['user'=>$user])),
            Column::make('Name')->sortable()->searchable(),
            
            // format value
            Column::make('Phone')->sortable()
                ->searchable()
                ->format(fn($v) => '(+1)'.$v),
            
            // add class to column
            Column::make('Address')
                ->addClass('text-red-700'),
            Column::make('Email')
                ->sortable()
                ->searchable()
                ->render(fn(User $user) => view('users.email', ['user' => $user])),
                
            // format value as html
            Boolean::make('Admin', 'is_admin')
                ->sortable()
                ->format(fn($v) => '<span class="text-green-300">' . $v . '</span>')
                ->asHtml(),

            Column::make('Created At')
                ->sortable()
                ->format(fn(Carbon $v) => $v->diffForHumans()),
            
            // sticky on right with default actions (show, edit, delete)
            Action::make()->sticky()
        ];
    }

    public function filters(): array
    {
        return [
            BooleanFilter::make('is_admin')
        ];
    }
    
    /*
     * Table row click callback.
     */
    public function rowOnClick(User $user)
    {
        return redirect(route('users.edit', $user->id));
    }
}
```
