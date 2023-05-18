<?php

namespace App\Tasks\Automations;

use App\Commands\Automations\DeleteAutomationSource;
use Closure;

final class DeleteAutomationSourceTask
{
    public function __construct(private readonly DeleteAutomationSource $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $source = $payload->get('source');
        $automation = $payload->get('automation');
        $this->command->handle($automation, $source);

        return $next($payload);
    }
}
