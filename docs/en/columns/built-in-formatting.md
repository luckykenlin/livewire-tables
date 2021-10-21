# Built-in formatting

If you would like to format the cell inline:

```php
Column::make('Created At')
    ->sortable()
    ->format(function($value) {
        return timezone()->convertToLocal($value);
    }),
```

**Note:** If you need more control, the full parameter list for the format callback is `$value, $column, $row`.

If you would like to render HTML from the format method, you may call `asHtml` on the column.

```php
Column::make('Created At')
    ->sortable()
    ->format(function($value) {
        return '<strong>'.timezone()->convertToLocal($value).'</strong>';
    })
    ->asHtml(),
```
