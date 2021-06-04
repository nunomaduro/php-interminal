<?php

namespace App\Contracts;

interface Rss
{
    /**
     * Get the RSS items.
     *
     * @return \Illuminate\Support\Collection
     */
    public function items();
}
