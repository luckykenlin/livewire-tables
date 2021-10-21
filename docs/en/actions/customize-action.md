# Customize Action

?> To customize action, you must specify a view 

Below is an example of how to customize action:

```php
public function columns() : array
{
    return [
        Column::make('ID'),
        Column::make('Name'),
        Action::make()
           ->render(
                 fn(User $user) => view('users.actions', compact('user'))
        )   
    ];
}
```

As you can see, it is only necessary to add `Action::make()->render(fn)` which is same function as [Column](en/columns/built-in-view.md) in the **Table Component**.

Below is the example for the **Blade** view:

```php 
<div class="flex justify-start text-gray-400 -ml-1">

    <!-- Customzie button -->
        <a
            href="url_you_need_to_redirect"
            class="py-2 px-1 hover:text-red-600"
        >
           Redirect
        </a>
</div>

```


