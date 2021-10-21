### Boolean Column
The Boolean column may be used to represent a boolean / "tiny integer" column in your database. For example, assuming your database has a boolean column named active, you may attach a Boolean column to your resource like so:

```php 
use Luckykenlin\LivewireTables\Views\Boolean;

Boolean::make('Active'),
```

### Customizing True / False Values
If you are using values other than true, false, 1, or 0 to represent "true" and "false", you may instruct Nova to use the custom values recognized by your application. To accomplish this, chain the trueValue and falseValue methods onto your field's definition:

```php 
Boolean::make('Active')
    ->trueValue('On')
    ->falseValue('Off'),
```
