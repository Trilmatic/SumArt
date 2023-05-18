<?php

namespace App\Tasks\Automations;

use App\Commands\Automations\StoreAutomation;
use Closure;

final class StoreAutomationTask
{
    public function __construct(private readonly StoreAutomation $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $automation = $this->command->handle($payload);
        $payload->put('automation', $automation);
        return $next($payload);
    }
}
