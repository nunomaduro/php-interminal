<?php

namespace App\Repositories;

use Algolia\AlgoliaSearch\SearchIndex;
use App\Contracts\Rss;
use DOMDocument;
use Feed;
use Illuminate\Support\Carbon;

class MailRepository
{
    /**
     * Holds an RSS instance.
     *
     * @var \App\Contracts\Rss
     */
    protected $rss;

    /**
     * Creates a new repository instance.
     *
     * @param  \App\Contracts\Rss $rss
     * @return void
     */
    public function __construct(Rss $rss)
    {
        $this->rss = $rss;
    }

    /**
     * Returns the latest mails.
     *
     * @return \Illuminate\Support\Collection
     */
    public function latest()
    {
        return $this->rss->items()->reverse()->take(5)->map(function ($item) {
            $contents = file_get_contents($item['link']);
            $dom = new DOMDocument();
            @$dom->loadHTML($contents);

            [$contents] = $dom->getElementsByTagName('pre');
            [$_, $fromName] = $dom->getElementsByTagName('td');

            $subject = trim(collect(explode('Re: ', $item['title']))->last());
            $createdAt = Carbon::createFromFormat(\DateTimeInterface::RFC2822, $item['pubDate']);

            return $contents ? [
                'extract' => $contents->nodeValue,
                'subject' => $subject,
                'fromName' => $fromName->nodeValue,
                'createdAt' => $createdAt->diffForHumans(),
            ] : null;
        })->filter()->values();
    }
}
