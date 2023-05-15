<?php

namespace App\Observers;

use DOMDocument;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use League\HTMLToMarkdown\HtmlConverter;

class RssCrawlerObserver extends CrawlObserver
{
    /*
    public function removeTags($tags)
    {
        for ($i = 0; $i < $tags->length; $i++) {
            if (is_object($tags->item($i)->parentNode)) {
                $tags->item($i)->parentNode->removeChild($tags->item($i));
            }
        }
    }*/

    /**
     * Called when the crawler will crawl the url.
     *
     * @param \Psr\Http\Message\UriInterface $url
     */
    public function willCrawl(UriInterface $url): void
    {
    }

    /**
     * Called when the crawler has crawled the given url successfully.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null
    ): void {
        if ($response->hasHeader('Content-Type')) {
            dd($response->getHeader('Content-Type'));
        }
        /*@$doc->loadHTML($response->getBody());
        $this->removeTags($doc->getElementsByTagName('script'));
        $this->removeTags($doc->getElementsByTagName('style'));
        $body = $doc->getElementsByTagName('body');
        if ($body && 0 < $body->length) {
            $body = $body->item(0);
            $content = $doc->savehtml($body);
            $markdown = $converter->convert($content);
            $text = strip_tags($markdown);
        }*/
    }

    /**
     * Called when the crawler had a problem crawling the given url.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \GuzzleHttp\Exception\RequestException $requestException
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null
    ): void {
    }

    /**
     * Called when the crawl has ended.
     */
    public function finishedCrawling(): void
    {
    }
}
