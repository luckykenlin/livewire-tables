<?php

namespace Luckykenlin\LivewireTables\Views;

class Action extends Column
{
    /**
     * @var string
     */
    public static string $type = 'action';

    /**
     * Hide show button on default view.
     *
     * @var bool
     */
    protected bool $hideShowButton;

    /**
     * Hide edit button on default view.
     *
     * @var bool
     */
    protected bool $hideEditButton;

    /**
     * Hide delete button on default view.
     *
     * @var bool
     */
    protected bool $hideDeleteButton;

    /**
     * Hide show button via callback.
     *
     * @var null|callable
     */
    protected $hideShowButtonCallback = null;

    /**
     * Hide edit button via callback.
     *
     * @var null|callable
     */
    protected $hideEditButtonCallback = null;

    /**
     * Hide delete button via callback.
     *
     * @var null|callable
     */
    protected $hideDeleteButtonCallback = null;

    /**
     * Stick action column.
     *
     * @var bool
     */
    public bool $sticky;

    /**
     * Action construct.
     *
     * @param string|null $field
     * @param string|null $view
     */
    public function __construct(?string $field, ?string $view)
    {
        parent::__construct($field);

        $this->hideShowButton = ! static::enabled(static::enableShowAction());

        $this->hideEditButton = ! static::enabled(static::enableEditAction());

        $this->hideDeleteButton = ! static::enabled(static::enableDeleteAction());

        $this->sticky = static::enabled(static::enableSticky());

        $this->view = $view ?: 'livewire-tables::'.config('livewire-tables.theme').'.components.table.action';
    }

    /**
     * Preset action column with default view.
     *
     * @param string      $field
     * @param string|null $view
     *
     * @return Action
     */
    public static function make(string $field = 'Action', ?string $view = null): Action
    {
        return tap(new static($field, $view), function (Action $action) {
            $action->render(
                fn ($model) => view($action->view, [
                    'row' => $model,
                    'action' => $action,
                ])
            )
                ->addClass($action->sticky ? 'sticky right-0' : '')
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
     * @param bool|callable $condition
     *
     * @return $this
     */
    public function hideShowButtonIf($condition): static
    {
        if (is_callable($condition)) {
            $this->hideShowButtonCallback = $condition;
        }

        if (is_bool($condition)) {
            $this->hideShowButton = $condition;
        }

        return $this;
    }

    /**
     * @param bool|callable $condition
     *
     * @return $this
     */
    public function hideEditButtonIf($condition): static
    {
        if (is_callable($condition)) {
            $this->hideEditButtonCallback = $condition;
        }

        if (is_bool($condition)) {
            $this->hideEditButton = $condition;
        }

        return $this;
    }

    /**
     * @param bool|callable $condition
     *
     * @return $this
     */
    public function hideDeleteButtonIf($condition): static
    {
        if (is_callable($condition)) {
            $this->hideDeleteButtonCallback = $condition;
        }

        if (is_bool($condition)) {
            $this->hideDeleteButton = $condition;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function sticky(): static
    {
        $this->sticky = true;

        return $this;
    }

    /**
     * Determine if default action enable.
     *
     * @param string $feature
     *
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
        return 'show-action';
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

    /**
     * Enable stick feature.
     *
     * @return string
     */
    public static function enableSticky(): string
    {
        return 'sticky';
    }

    /**
     * Resolve hide show button logic.
     *
     * @param object $model
     *
     * @return bool
     */
    public function resolveHideShowButton(object $model): bool
    {
        if (is_callable($this->hideShowButtonCallback)) {
            return call_user_func($this->hideShowButtonCallback, $model);
        }

        return $this->hideShowButton;
    }

    /**
     * Resolve hide edit button logic.
     *
     * @param object $model
     *
     * @return bool
     */
    public function resolveHideEditButton(object $model): bool
    {
        if (is_callable($this->hideEditButtonCallback)) {
            return call_user_func($this->hideEditButtonCallback, $model);
        }

        return $this->hideEditButton;
    }

    /**
     * Resolve hide delete button logic.
     *
     * @param object $model
     *
     * @return bool
     */
    public function resolveHideDeleteButton(object $model): bool
    {
        if (is_callable($this->hideDeleteButtonCallback)) {
            return call_user_func($this->hideDeleteButtonCallback, $model);
        }

        return $this->hideDeleteButton;
    }
}
