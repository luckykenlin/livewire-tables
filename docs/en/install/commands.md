# Commands
> Generating Datatable Components

To generate a new datatable component you can use the `make:table` command:

Create a new table component called UserTable in App\Http\Livewire
```bash
php artisan make:datatable UserTable
```

Create a new datatable component called UserTable in App\Http\Livewire that uses the App\Models\User model.
```bash
php artisan make:datatable UserTable --model=User
```
