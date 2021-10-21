# Built-in searching

There are multiple ways to apply searching to a column, but the easiest is using the built-in column searchable() method.

```php
Column::make('Type')
    ->searchable(),
```

You can also apply it to relationship columns:

```php
Column::make('Address', 'attributes.address')
    ->searchable(),
```

You can override the default search query using a closure:

```php
Column::make('Type')
    ->searchable(function (Builder $query, $searchTerm) {
        $query->orWhere(...);
    }),
```

If you do not add the searchable() method then the column will not be included when searching the term.

### Conditionally search columns

If you would like to search columns based on a conditional, you may use the `searchIf` method on the Column builder:

```php
Column::make('Special Field')
    ->searchIf(! auth()->user()->isAdmin());
```


### Advance

If you know you need more advanced searching from the start, just specifying how that search acts on the query.

```php
public function query(): Builder
{
    return User::query()
              ->when($this->search, function($query){
                    $query->search($this->search);
              });
}
```

In the `User` model.

```php
public function scopeSearch(Builder $query, string $search)
{
    return $query
        ->where('name', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%');
}
```
