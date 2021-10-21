# Filters

The filters will allow us to show a more precise results, discarding those that do not fill with the established criteria. Each filter consists of two
parts: the **Filter Component** and the **Blade view**. This structure and this operation is similar to the one used
by [Laravel Nova](https://nova.laravel.com/docs/3.0/filters/defining-filters.html).

Let's first look at the basics of the **Filter Component**.

### Component

Let's see a complete example of what a Filter Component would look like:

```php
<?php

namespace App\Http\Filters;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\UserType;
use Luckykenlin\LivewireTables\Components\Filter;
use Luckykenlin\LivewireTables\Helper;

class UserType extends Filter
{
    /**
     * Custom filter
     *
     * @param string|null $uriKey
     */
    public function __construct(?string $uriKey = '')
    {
        parent::__construct($uriKey);

        $this->view = 'admin.filters.user-type';
        $this->uriKey = 'user';
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public function apply(Request $request, Builder $builder, mixed $value): Builder
    {
        return $builder->where(
            Helper::getTableColumn($builder, 'type'),
            $value
        );
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options()
    {
        return UserType::all()
                ->pluck('name')
                ->toArray();
    }

    /**
     * Render filter view
     *
     * @return View
     */
    public function render(): View
    {
        return view($this->view, [
            'uriKey' => $this->uriKey,
            'options' => $this->options(),
        ]);
    }
}

```

Each filter must extend `Luckykenlin\LivewireTables\Components\Filter` class:

```php
<?php

namespace Luckykenlin\LivewireTables\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
//    '''
    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    abstract public function apply(Request $request, Builder $builder, mixed $value): Builder;

    /**
     * @return View
     */
    abstract protected function render(): View;
//   '''
}
```

Let's see in detail, the three parts in which the component can be divided.

### __construct()

In the constructor we will have to define several attributes:

| Attribute | Example | Description |
| :---------- |:------------| :------------|
| $view | `$this->view ='path.to.the.filter.view'` | Defines the location where the view is located. |
| $uriKey | `$this->uriKey = 'user'` | Define the filter unique name. This field is inspired in Laravel Nova documentation. |

In the example above, the constructor part would look like this:

```php
/**
 * Create a new field.
 */
public function __construct(?string $uriKey = null)
{
    parent::__construct($uriKey);

    $this->view = 'admin.filters.user-type';
    $this->uriKey = 'user';
}
```

### apply()

It is the filter itself. It is about defining the search in the database.

```php
/**
 * Apply the filter to the given query.
 *
 * @param Request $request
 * @param Builder $builder
 * @param mixed $value
 * @return Builder
 */
public function apply(Request $request, Builder $builder, mixed $value): Builder
{
    return $builder->where(
        Helper::getTableColumn($builder, 'type'),
        $value
    );
}
```

!> It is important to note that we must create an instance of `\Illuminate\Database\Eloquent\Builder`.

The `Luckykenlin\LivewireTables\Helper::getTableColumn()` method is available as a helper when we want to use the name of the table column.

| Method | Example | Description |
| :---------- |:------------| :------------|
| getTableColumn() | `Helper::getTableColumn($builder, 'type')` | It is used to call the database column automatically and in a homogenized way. **It is recommended to use this method instead of the column name.** |

?> It is important to use the method `Helper::getTableColumn()`, since it will allow us to homogenize the code and thus avoid problems with the database when we
use related tables.

### options()

It is used to return the array with the filter options to the view. In this case, the values ​​have been obtained directly from the database, but they
can be sent directly in an `array` without database.

```php

/**
 * Get the filter's available options.
 *
 * @return array
 */
public function options()
{
    return UserType::all()
            ->pluck('name')
            ->toArray();
}
```

Or you can just return an `array` with values:

```php
/**
 * Set the filter query.
 *
 * @return  array<string>
 */
public function options(): array
{
    return [
        'guest', 
        'user', 
        'editor', 
        'admin', 
        'super-admin'
    ];
}
```

!> It is important to note that you must return an `array`.

### View

Let's see a complete example of what a view would look like:

```html
<!-- Filter -->
<div class="block text-sm text-gray-700" role="menuitem">
    <label for="filter-{{ $uriKey }}"
           class="block py-2 px-4 font-semibold leading-5 text-gray-700 dark:text-white bg-indigo-100">
        '{{__('UserType')}}
    </label>

    <div class="px-4 py-3 relative shadow-sm">
        <select
            wire:model.stop="filters.{{ $uriKey }}"
            id="filter-{{ $uriKey }}"
        >
            @foreach($options => $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        <//select>
    </div>
</div>

```

It is important that the name of the filter that we asign in the **Filter Component** is the same as the one that we define in the view:

```html
wire:model.stop="filters.{{ $uriKey }}"
```

### Usage
```php 
public function filters(): array
{
    return [
        new UserType()
    ];
}
```

### Default filters

**Livewire Tables** includes a list of default filters:

| Filter | Class | Description |
| :---------- |:------------| :------------|
| BooleanFilter | `BooleanFilter:class` | It is used to filter `bool column`, very useful for `active` or `not active` fields. |
