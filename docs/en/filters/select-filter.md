# Select filters

Livewire Table also supports `select` filters, which allow the user to select filter options via select:

```php
public function filters(): array
{
    return [
       SelectFilter::make('role', 'select')
            ->options([
                '' => 'All',
                Role::ADMIN => 'Admin',
                Role::GUEST => 'Guest',
                Role::MANAGER => 'Manager',
                Role::OWNER => 'Owner',
            ]),
    ];
}
```

![Livewire Tables with Select Filter](/../../assets/select-filter.png ':class=image')

### How it works
```php
public function apply(Request $request, Builder $builder, mixed $value): Builder
{
    $column = Helper::getTableColumn($builder, $this->column);

    return $builder->where($column, $value);
}
```
