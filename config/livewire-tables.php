<?php

use Luckykenlin\LivewireTables\Views\Action;

return [

    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    |
    | The frontend styling framework to use
    | Options: tailwind
    |
    */

    'theme' => 'tailwind',

    /*
    |--------------------------------------------------------------------------
    | Default Per Page
    |--------------------------------------------------------------------------
    | Sets the default amount of rows to display per page.
    |
    */

    'per_page' => 10,

    /*
    |--------------------------------------------------------------------------
    | Per Page Options
    |--------------------------------------------------------------------------
    | Define the options to choose from in the `Per Page`dropdown.
    |
    */

    'per_page_options' => [10, 25, 50, 100],

    /*
    |--------------------------------------------------------------------------
    | Empty Message
    |--------------------------------------------------------------------------
    |
    | Define default message while no data response.
    |
    */

    'empty_message' => 'Whoops! No results.',

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
    ],

];
