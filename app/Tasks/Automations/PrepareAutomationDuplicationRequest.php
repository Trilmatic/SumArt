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
        $source_list = [];
        foreach ($automation->sources()->get() as &$source) {
            array_push(
                $source_list,
                [
                    'url' => $source['url']
                ]
            );
        }
        $name = $automation->name . " (2)";
        $payload->put('name', $name);
        $payload->put('frequency', $automation->frequency);
        $payload->put('time_at', $automation->time_at);
        $payload->put('type', $automation->type);
        $payload->put('source', $source_list);
        $payload->put('automation', null);
        return $next($payload);
    }
}
