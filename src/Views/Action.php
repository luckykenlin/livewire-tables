<?php

namespace Luckykenlin\LivewireTables\Views;

class Action extends Column
{
    /**
     * Hide show button on default view.
     *
     * @var bool
     */
    public bool $hideShowButton;

    /**
     * Hide edit button on default view.
     *
     * @var bool
     */
    public bool $hideEditButton;

    /**
     * Hide delete button on default view.
     *
     * @var bool
     */
    public bool $hideDeleteButton;

    /**
     * Action construct.
     *
     * @param string|null $field
     * @param string|null $attribute
     */
    public function __construct(?string $field, ?string $attribute)
    {
        parent::__construct($field, $attribute);

        $this->hideShowButton = ! static::enabled(static::enableShowAction());

        $this->hideEditButton = ! static::enabled(static::enableEditAction());

        $this->hideDeleteButton = ! static::enabled(static::enableDeleteAction());

        $this->view = 'livewire-tables::' . config('livewire-tables.theme') . '.components.table.action';
    }

    /**
     * Preset action column with default view.
     *
     * @param string $field
     * @param string|null $attribute
     * @return Action
     */
    public static function make(string $field = 'Action', ?string $attribute = null): Action
    {
        return tap(new static($field, $attribute), function ($action) {
            $action->render(
                fn ($model) => view($action->view, [
                    'row' => $model,
                    'hideShowButton' => $action->hideShowButton,
                    'hideEditButton' => $action->hideEditButton,
                    'hideDeleteButton' => $action->hideDeleteButton,
                ])
            )
                ->excludeFromExport();
        });
    }

    /**
     * Hide show button.
     *
     * @return $this
     */
    public function hideShowButton(): static
    {
        $this->hideShowButton = true;

        return $this;
    }

    /**
     * Hide edit button.
     *
     * @return $this
     */
    public function hideEditButton(): static
    {
        $this->hideEditButton = true;

        return $this;
    }

    /**
     * Hide delete button.
     *
     * @return $this
     */
    public function hideDeleteButton(): static
    {
        $this->hideDeleteButton = true;

        return $this;
    }

    /**
     * @param bool $condition
     * @return $this
     */
    public function hideShowButtonIf(bool $condition): static
    {
        $this->hideShowButton = $condition;

        return $this;
    }

    /**
     * @param bool $condition
     * @return $this
     */
    public function hideEditButtonIf(bool $condition): static
    {
        $this->hideEditButton = $condition;

        return $this;
    }

    /**
     * @param bool $condition
     * @return $this
     */
    public function hideDeleteButtonIf(bool $condition): static
    {
        $this->hideDeleteButton = $condition;


        return $this;
    }

    /**
     * Determine if default action enable.
     *
     * @param string $feature
     * @return bool
     */
    public static function enabled(string $feature): bool
    {
        return in_array($feature, config('livewire-tables.actions', []));
    }

    /**
     * Enable the show feature.
     *
     * @return string
     */
    public static function enableShowAction(): string
    {
        return 'edit-action';
    }

    /**
     * Enable the edit feature.
     *
     * @return string
     */
    public static function enableEditAction(): string
    {
        return 'edit-action';
    }

    /**
     * Enable the delete feature.
     *
     * @return string
     */
    public static function enableDeleteAction(): string
    {
        return 'delete-action';
    }
}
