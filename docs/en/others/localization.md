# Localization

publish translation files via
```bash 
php artisan vendor:publish --provider="Luckykenlin\LivewireTables\LivewireTablesServiceProvider" --tag=livewire-tables-translations
```

**Livewire Tables** use this localization files:

- `resources/lang/vendor/livewire-tables/en/pagination.php`
- `resources/lang/vendor/livewire-tables/en/filters.php`
- `resources/lang/vendor/livewire-tables/en/strings.php`

So far, the **package** only support English, but I hope soon there will be more languages.
