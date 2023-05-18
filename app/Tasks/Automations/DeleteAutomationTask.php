<?php

namespace App\Tasks\Automations;

use App\Commands\Automations\DeleteAutomation;
use Closure;

final class DeleteAutomationTask
{
    public function __construct(private readonly DeleteAutomation $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $this->command->handle($payload);
        return $next($payload);
    }
}
