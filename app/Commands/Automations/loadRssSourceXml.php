<?php

namespace  App\Commands\Automations;

use Throwable;

final class loadRssSourceXml
{
    public function handle($source)
    {
        try {
            return simplexml_load_file($source);
        } catch (Throwable $e) {
            return false;
        }
    }
}
