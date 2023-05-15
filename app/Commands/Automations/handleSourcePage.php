<?php

namespace  App\Commands\Automations;

use Spatie\Crawler\Crawler;
use App\Observers\RssCrawlerObserver;

final class handleSourcePage
{
    public function handle($source)
    {
        dd(Crawler::create()
            ->setParseableMimeTypes(['text/html', 'text/plain'])
            ->setCrawlObserver(new RssCrawlerObserver())
            ->setTotalCrawlLimit(1)
            ->startCrawling($source));
    }
}
