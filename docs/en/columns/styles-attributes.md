# Styles & Attributes

### Adding a class to the column headers

```php
Column::make('Name')
    ->addClass('hidden md:table-cell'), // Hide this header on mobile
```

### Adding any attribute to the column headers

```php
Column::make('Name')
    ->addAttributes(['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Tooltip on top']),
```
