# Boolean filters

Livewire Table also supports `boolean` filters, which allow the user to select filter options via select:

```php
public function filters(): array
{
    return [
        BooleanFilter::make('is_admin'),
        BooleanFilter::make('gender')
            ->trueValue('Male')
            ->falseValue('Female'),
    ];
}
```

![Livewire Tables with Boolean Filter](/../../assets/boolean-filter.png ':class=image')

