<?php

namespace Luckykenlin\LivewireTables\Traits;

trait NewResource
{
    /**
     * @var string
     */
    public string $newResource = '';

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function invokeNewResource()
    {
        if (!$this->hasNewResource()) return;

        if (method_exists($this, 'newResource')) {
            return $this->newResource();
        }

        if ($this->newResource) {
            return redirect()->to($this->newResource);
        }
    }

    /**
     * @return bool
     */
    public function hasNewResource(): bool
    {
        if ($this->newResource) {
            return true;
        }

        if (method_exists($this, 'newResource')) {
            return true;
        }

        return false;
    }
}
