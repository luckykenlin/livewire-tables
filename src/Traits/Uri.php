<?php

namespace Luckykenlin\LivewireTables\Traits;

/**
 * Trait Uri
 * @package Luckykenlin\LivewireTables\Traits
 */
trait Uri
{
    /**
     * @var string
     */
    public $uriKey = '';

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return $this->uriKey;
    }

    /**
     * @param $uri
     * @return Uri
     */
    public function setUriKey($uri)
    {
        $this->uriKey = $uri;

        return $this;
    }
}
