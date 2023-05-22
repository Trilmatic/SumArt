<?php

namespace App\Tasks\Automations;

use Closure;

final class PrepareAutomationDuplicationRequest
{
    public function __construct()
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $automation = $payload->get('automation');
        $source = [];
        foreach ($automation->sources() as &$source) {
            array_push(
                [
                    'url' => $source->url
                ]
            );
        }
        $payload->put('name', $automation->name . " (duplicate)");
        $payload->put('frequency', $automation->frequency);
        $payload->put('time_at', $automation->time_at);
        $payload->put('type', $automation->type);
        $payload->put('source', $source);
        $payload->put('automation', null);
        return $next($payload);
    }
}
