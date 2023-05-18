<?php

namespace App\Tasks\Automations;

use App\Commands\Automations\DeleteAutomationSource;
use Closure;

final class DeleteAutomationSourcesTask
{
    public function __construct(private readonly DeleteAutomationSource $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $automation = $payload->get('automation');
        foreach ($automation->sources as &$source) {
            $this->command->handle($automation, $source);
        }
        return $next($payload);
    }
}
