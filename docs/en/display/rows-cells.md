# Customizing table rows and cells

### Table Classes

You may replace the classes on the table component with the following method:

```php
public function setTableClass($row): ?string
{
    return null;
}
```

### Classes, ID's, and Attributes

This feature is available in v1.8 and above

Sometimes you may wish to alter a row or cell depending on the contents within it. You have access to these class methods to hook into rendering of these rows and cells:

You do not need to define these methods if you are not going to use them.

`$row` is an instance of the current iteration of your Eloquent collection.

```php
public function setTableRowClass($row): ?string
{
    return null;
}
```

```php
public function setTableRowId($row): ?string
{
    return null;
}
```

```php
public function setTableRowAttributes($row): array
{
    return [];
}
```

```php
public function setTableCellClass(Column $column, $row): ?string
{
    return null;
}
```

```php
public function setTableCellId(Column $column, $row): ?string
{
    return null;
}
```

```php
public function setTableCellAttributes(Column $column, $row): array
{
    return [];
}
```

### Examples:

```php
public function setTableRowClass($row): ?string
{
    return $row->isSuccess() ? 'bg-green-500' : null;
}
```

```php
public function setTableRowId($row): ?string
{
    return 'row-' . $row->id;
}
```

```php
public function setTableRowAttributes($row): array
{
    return $row->hasFailed() ? ['this' => 'that'] : [];
}
```

```php
public function setTableDataClass(Column $column, $row): ?string
{
    if ($column->column() === 'email' && ! $row->isVerified()) {
        return 'text-danger';
    }

    return null;
}
```

```php
public function setTableCellId(Column $column, $row): ?string
{
    if ($column->column() === 'email') {
        return 'user-email-' . $row->id;
    }

    return null;
}
```

```php
public function setTableCellAttributes(Column $column, $row): array
{
    if ($column->column() === 'email' && ! $row->isVerified()) {
        return ['this' => 'that'];
    }

    return [];
}
```

### Action column `sticky` on right

```php
use Luckykenlin\LivewireTables\Views\Action;

Action::make()->sticky()
```
