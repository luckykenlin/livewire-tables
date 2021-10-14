<?php

namespace Luckykenlin\LivewireTables\Views;

class Action
{
    /**
     * Action column constructor.
     */
    public static function make(string $field = '', ?string $view = null): Column
    {
        return Column::make($field)
            ->render(function ($model) use ($view) {

                $component = $view ?? self::defaultView();

                return view($component, [
                    'id' => $model->id,
                    'resource' => $model->getTable()
                ]);
            })
            ->excludeFromExport();
    }

    /**
     * Default action view.
     */
    private static function defaultView(): string
    {
        return 'livewire-tables::' . config('livewire-tables.theme_template') . '.components.table.action';
    }
}
