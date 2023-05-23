<?php

namespace App\Tasks\Automations;

use App\Commands\Automations\LogAutomationSourceDeletion;
use Closure;

final class LogAutomtionSourceDeletionTask
{
    public function __construct(private readonly LogAutomationSourceDeletion $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $this->command->handle($payload);
        return $next($payload);
    }
}
