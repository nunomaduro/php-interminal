<?php

namespace App\Providers;

use App\Contracts\Rss;
use App\Services\UrlRss;
use Illuminate\Support\ServiceProvider;

class RssServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Rss::class, function () {
            return new UrlRss(
                'https://news-web.php.net/group.php?group=php.internals&format=rss',
            );
        });
    }
}
