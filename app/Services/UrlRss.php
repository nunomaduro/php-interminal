<?php

namespace App\Services;

use App\Contracts\Rss;
use Feed;

class UrlRss implements Rss
{
    /**
     * The RSS Url.
     *
     * @var string
     */
    protected $url;

    /**
     * Creates a new RSS provider.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the RSS items.
     *
     * @return \Illuminate\Support\Collection
     */
    public function items()
    {
        $items = [];

        $value = fn($value) => trim($value->__toString());

        foreach (Feed::loadRss($this->url)->item as $item) {
            $items[] = [
                'link' => $value($item->link),
                'title' => $value($item->title),
                'description' => $value($item->description),
                'pubDate' => $value($item->pubDate),
            ];
        }

        return collect($items);
    }
}
