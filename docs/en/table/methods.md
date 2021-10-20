# Methods

There are multiple ways to customize table, Now, let's look forward.

## query()
?> This defines the start of the query, usually Model::query() but can also eager load relationships and counts if needed.

```php
public function query(): Builder
{
    return User::query();
}
```
## columns()
?> This defines the columns of the table, they don't necessarily have to map to columns on the database table. This must return [`Columns`](en/column/general-methods.md) array.

```php
public function columns(): array
{
    return [
        Column::make('#', 'id')->sortable(),
        
        Column::make('Name')->sortable()->searchable(),
        
        Column::make('Email')->sortable()->searchable(),
        
        Column::make('Created At')
            ->sortable()
            ->format(fn(Carbon $v) => $v->diffForHumans()),
            
        Action::make()
    ];
}
```
## filter()
?> The filters will allow us to show a more precise results, discarding those that do not fill with the established criteria. This should return [`Filter`](en/filter/general-methods.md) array.

```php
 public function filters(): array
{
    return [
        BooleanFilter::make('is_admin')
    ];
}
```
## view()
?> You can customize table component view using this view method. Use the path to your view in your system.
```php
public function view(): string
{
    return 'livewire.table';
}
```
!> Note: I don't recommend you edit the views unless you really need to change them. You can publish default view and see how to apply functionality with it.
```bash
php artisan vendor:publish --provider="Luckykenlin\LivewireTables\LivewireTablesServiceProvider" --tag=livewire-tables-views
```
## newResource()
?> There is a way to add a add-new-resource-button to the model shown in the table. This button looks like this (at the top right of the image):

![New Resource](/../../assets/new-resource.png ':class=image')

## rowOnClick()
?> If you would like to make the whole row clickable, you may use the rowOnClick method.

```php
public function rowOnClick(User $user)
{
    return redirect(route('users.edit', $user->id));
}
```

[comment]: <> (## setTableClass&#40;&#41;)

[comment]: <> (## setTableRowClass&#40;&#41;)

[comment]: <> (## setTableRowId&#40;&#41;)

[comment]: <> (## setTableRowAttributes&#40;&#41;)

[comment]: <> (## setTableCellClass&#40;&#41;)

[comment]: <> (## setTableCellId&#40;&#41;)

[comment]: <> (## setTableCellAttributes&#40;&#41;)
