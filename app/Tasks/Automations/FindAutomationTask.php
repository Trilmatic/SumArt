<?php

namespace App\Tasks\Automations;

use App\Queries\Automations\FindAutomation;
use Closure;

final class FindAutomationTask
{
    public function __construct(private readonly FindAutomation $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $automation = $this->command->handle($payload->get('hash'));
        $payload->put('automation', $automation);
        return $next($payload);
    }
}
