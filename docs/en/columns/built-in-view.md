# Built-in View

And finally, we leave the method that will allow us to add custom views to the column. This method will be able to manage the design using Blade.

This method needs a more detailed explanation. And the best way to understand it is with a complete example, showing the component and the view. Let's start with the component:

```php 
public function columns() : array
{
    return [
        Column::make('ID')
            ->searchable()
            ->sortable(),
        Column::make('Name')
            ->searchable()
            ->sortable()
            ->format(static function($value) {
                return Str::of($value)
                    ->title();
            })
        Column::make('Profile', 'profile.profile_telephone')
            ->searchable()
            ->sortable()
            ->render(function(User $user) {
                return view('dashboard.user.profile', compact('user'));
            }),
        Column::make('E-mail', 'email')
    ];
}
```

Now we need the view `resources\views\dashboard\user\profile.blade.php`.

```html 
<div class="flex items-center">
    <div class="ml-4">
        <div class="text-sm font-medium text-gray-900">
            {{ $user->name }}
        </div>  
        <div class="text-sm text-gray-500">
            {{ $user->email }}
        </div>
    </div>
</div>
```

