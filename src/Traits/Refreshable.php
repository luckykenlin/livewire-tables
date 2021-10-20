<?php

namespace Luckykenlin\LivewireTables\Traits;

trait Refreshable
{
    /**
     * Whether to refresh the table at a certain interval
     * false is off
     * If it's an integer it will be treated as milliseconds (2000 = refresh every 2 seconds)
     *
     * @var bool
     */
    public bool $refresh = false;

    /**
     * Refresh table each XX seconds.
     */
    public int $refreshInSeconds = 2;
}
