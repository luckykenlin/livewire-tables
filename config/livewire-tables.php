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
    | Empty Message
    |--------------------------------------------------------------------------
    |
    | Default message while no data response.
    |
    */
    'empty_message' => 'Whoops! No results.',

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    |
    | Preset for default actions, You may disable the actions
    | by removing them from this array.
    | Notice: you can cover this via Action class.
    |
    */
    'actions' => [
        Action::enableShowAction(),
        Action::enableEditAction(),
        Action::enableDeleteAction(),
    ]

];
