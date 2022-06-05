# Actions

With the actions, we will be able to perform the operations of: **show**, **edit** and **delete**. **Livewire Tables** automatically enables and configure the action of **delete**, and prepare the actions of **show** and **edit**. When you define the actions, the icons for **show**, **edit** and **delete**, appear as shown below:

![Livewire Tables with actions](/../../assets/actions.png ':class=image')

Below is an example of how to activate the actions:

```php
public function columns() : array
{
    return [
        Column::make('ID'),
        Column::make('Name'),
        Action::make(),
    ];
}
```

As you can see, it is only necessary to add `Action::make()` in the **Table Component**. Additionally, a parameter can be added to the `make()` method, this parameter allows us to add the action header which default is 'Action'.
Let's see how can we set the action header 'Operator' and be hidden on mobile. 

```php
public function columns() : array
{
    return [
        Column::make('ID'),
        Column::make('Name'),
        Action::make('Operator')->addClass('hidden md:block'),
    ];
}
```

### Action button hidden
?> By default, the predetermine action is automatically loaded.

If you want to control how the action acts, you can use following methods:

| Property | Usage |
| -------- | ------- |
| `stick()` | Sticky action column on right |
| `hideShowButton()` | Hide the show button |
| `hideEditButton()` | Hide the edit button |
| `hideDeleteButton()` | Hide the delete button |
| `hideShowButtonIf()` | If you would like to show/hide show button based on a conditional, you may use the hideIf method.|
| `hideEditButtonIf()` | If you would like to show/hide edit button based on a conditional, you may use the hideIf method. |
| `hideDeleteButtonIf()` |If you would like to show/hide delete button based on a conditional, you may use the hideIf method. |

```php
public function columns(): array
{
    return [
        Column::make('#', 'id')->sortable(),
        Column::make('Name')->sortable()->searchable(),
        
        Action::make()->hideDeleteButtonIf(! auth()->user()->isAdmin()),
       
//      Or use callback function 
//      Action::make()->hideDeleteButtonIf(fn(User $user) => auth()->id() === $user->id)
    ];
}
```
### Config as default

```php
  /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    |
    | Define for default actions, You may disable the actions
    | by removing them from this array.
    | Notice: you can cover this via Action class.
    |
    */

    'actions' => [
        Action::enableShowAction(),
        Action::enableEditAction(),
        Action::enableDeleteAction(),
//      Action::enableSticky()
    ]
```

### Default action view

Below is the code for the default **Blade** view:

```php 
<div class="flex justify-start text-gray-400 -ml-1">
@unless($action->resolveHideShowButton($row))
    <!-- Show button -->
        <a
            href="{{ sprintf('%s/%s', $row->getTable(), $row->id) }}"
            class="py-2 px-1 hover:text-green-600"
        >
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
        </a>
@endunless

@unless($action->resolveHideEditButton($row))
    <!-- Edit button -->
        <a
            href="{{ sprintf('%s/%s', $row->getTable(), $row->id) }}/edit"
            class="py-2 px-1 hover:text-blue-600"
        >
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>
@endunless

@unless($action->resolveHideDeleteButton($row))
    <!-- Delete button -->
        <a
            href="#"
            class="py-2 px-1 hover:text-red-600"
            wire:click.prevent="confirmDeletion({{$row->id}})"
        >
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </a>
@endunless
</div>

```

### Confirm delete modal

The delete button will trigger a confirm modal by default.

![Livewire Tables with delete modal](/../../assets/delete-modal.png ':class=image')

### New resource button

If you want to add a create button. check [New Resource](en/table/methods.md?id=newresource)

