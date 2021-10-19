<?php

namespace Luckykenlin\LivewireTables\Traits;

trait NewResource
{
    /**
     * @var string
     */
    public string $newResource;

    /**
     * Set new resource url.
     *
     * @return string
     */
    protected function newResource(): string
    {
        return '';
    }

    /**
     * Initialize
     */
    protected function initializeNewResource()
    {
        $this->newResource = $this->newResource ?? $this->newResource();
    }
}
