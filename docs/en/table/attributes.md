# Attributes

The attributes that you can use in a `Table Component` are described below. These attributes have been classified by groups, in order to facilitate their management.

[comment]: <> (## Export attributes)

[comment]: <> (| Attribute | Default | Example | Description |)

[comment]: <> (| :---------- |:------------ |:------------| :-----------| )

[comment]: <> (| $export | [] | `protected array $export = ['pdf', 'csv', 'xls']`| Defines the file formats that are allowed to be downloaded. If you leave it in blank, the export option will be canceled. |)

[comment]: <> (| $exportAllowedFormats | csv, xls, xlsx, pdf | `protected array $exportAllowedFormats = ['csv', 'pdf']`| Defines the file formats supported when exporting. |)

[comment]: <> (| $exportFileName | data | `protected string $exportFileName = 'data'`| Defines the file name for the exported file. |)

## Table attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $primaryKey | 'id' | `public string $primaryKey = 'id'`| Defines model primary key, it should be unique and select within query. |
| $refresh | false | `public bool $refresh = false`| Defines if the table will be refreshing at a certain interval of time. |
| $refreshInSeconds | 2 | `public int $refreshInSeconds`| Defines the interval of time, in seconds. |
| $offlineIndicator | true | `public bool $offlineIndicator = true`| Show or hide the offline message when there is no internet connection. |
| $debugEnable | false | `public bool $debugEnable = true`| Show or hide the sql debug message when is need. |
| $responsive | true | `public bool $responsive = true`| Enable/disable table responsiveness. |
| $emptyMessage | 'Whoops! No results.' | `public bool $emptyMessage = 'Whoops! No results.'`| Customize empty message when there is no result. |
| $model | - | `protected Model $model`| Model instance. |
| $table | - | `protected string $table`| Table name from model. |
| $builder | - | `protected Builder $builder`| Model builder. |

## Pagination attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $showPagination | true | `public bool $showPagination = true`| show or hide the pagination. |
| $paginationTheme | 'tailwind' | `public string $paginationTheme = 'talwind'`| Defines The pagination theme used by Laravel. By default will use the selection from the config file. |

## Per page attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $showPerPage | true | `public bool $showPerPage = true`| Show the selector with the per page options. |
| $perPageOptions | [10, 25, 50, 100] | `public array $perPageOptions = [10, 25, 50, 100]` | Define the interval of values for the attribute. |
| $perPage | 25 | `public int $perPage = 25`| Set the current value for the attribute. |

## Search attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $search | '' | `public bool $search = ''`| Search variable . |
| $showSearch | true | `public bool $showSearch = true`| Show or hide the search box. |
| $searchDebounce | 350 | `public int $searchDebounce = 350` | Amount of time in ms to wait to send the search query and refresh the table. |
| $clearSearchButton | true | `public bool $clearSearchButton = true`| Show or hide a button to clear the search box. |

## Sort attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $sorts | [] | `public string $sorts = []`| Sorts variable. |
| $sortingEnabled | true | `public bool $sortingEnabled = true`| Show or hide the sort function. |
| $singleColumnSorting | false | `protected bool $singleColumnSorting = false`| Enable single column sorting. |
| $defaultSortColumn | 'updated_at' | `protected string $defaultSortColumn = 'updated_at'`| The default sort field for the table. |
| $defaultSortDirection | desc | `protected string $defaultSortDirection = 'desc'`| The default sort direction for the table. |


## Filter attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $filters | [] | `public string $filters = []`| Filters variable. |
| $showFilter | true | `public bool $showFilter = true`| Show or hide the filter function. |

## Other attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $newResource | null | `public string $newResource = 'users/create'`| Set the url path for create a new resource. |
