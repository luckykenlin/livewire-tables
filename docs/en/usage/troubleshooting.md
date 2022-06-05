# Troubleshooting

If you are having unexpected results, try these before making an issue or discussion:

### 1. Delete your `resources/views/vendor/livewire-tables` folder if you have one and see if the issue persists with the vendor views.

### 2. Clear everything:

```
php artisan clear-compiled &&
php artisan cache:clear &&
php artisan route:clear &&
php artisan view:clear &&
php artisan config:clear &&
composer dumpautoload -o
```

### 3. If you are getting unexpected row results after filtering/search etc.

Make sure your query returns a column that is being used as the primary key for the row. By default, it looks for the `id` column but you can set it using the `$primaryKey` property.

Livewire uses this as the `wire:key` to know which rows to keep and remove during its dom-diffing.

!> Livewire table store all filter values as an array. please make sure all your filter has `unique` `uriKey`. livewire table use uriKey to retrieve filter value from query string.

### 4. Blip confirm model

Sometimes, when you're using AlpineJS for a part of your template, there is a "blip" where you might see your uninitialized template after the page loads, but before Alpine loads.

x-cloak addresses this scenario by hiding the element it's attached to until Alpine is fully loaded on the page.

For x-cloak to work however, you must add the following CSS to the page.

```css
[x-cloak] { display: none !important; }
```

### 5. Enable debugging

If you would like to dump sql above the table you may enable this flag:

```php
public bool $debugEnabled = true;
```
