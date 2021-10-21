# Conditionally hiding columns

If you would like to show/hide columns based on a conditional, you may use the `hideIf` method on the Column builder:

```php
Column::make('Special Field')
    ->hideIf(! auth()->user()->isAdmin());
```

!> **Note:** This only works for the corresponding cells if using the column builder to also build the rest of the table.
