# Built-in sorting

A column is either sortable or not.

**Note:** Sorting columns are stackable, if you would like only a single column to be sorted at a time, set the `$singleColumnSorting` class property to `true`.

For example:
```sql
->orderBy('name', 'asc')->orderBy('email', 'desc')...
```

You can make a column sortable by adding the sortable() method to the column:

```php
Column::make('Type')
    ->sortable()
```

If you would like more control over the sort behavior of a specific column, you may pass a closure:

```php
Column::make(__('Address'))
    ->sortable(function(Builder $query, $direction) {
        return $query->orderBy(UserAttribute::select('address')->whereColumn('user_attributes.user_id', 'users.id'), $direction);
    })
```

To set the default sort order that gets overwritten when someone clicks a column header, you can use these class properties:

```php
public string $defaultSortColumn = 'updated_at';
public string $defaultSortDirection = 'desc';
```
