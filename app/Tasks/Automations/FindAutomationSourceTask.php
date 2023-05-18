<?php

namespace App\Tasks\Automations;

use App\Queries\Automations\FindAutomation;
use App\Queries\Automations\FindAutomationSource;
use Closure;

final class FindAutomationSourceTask
{
    public function __construct(private readonly FindAutomationSource $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $source = $this->command->handle($payload->get('id'));
        $payload->put('source', $source);
        return $next($payload);
    }
}
