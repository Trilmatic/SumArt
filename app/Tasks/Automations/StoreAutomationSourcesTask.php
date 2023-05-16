<?php

namespace App\Tasks\Automations;

use App\Commands\Automations\StoreAutomation;
use App\Commands\Automations\StoreAutomationSource;
use App\Models\Automation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class StoreAutomationSourcesTask
{
    public function __construct(private readonly StoreAutomationSource $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $automation_id = $payload->get('automation')->id;

        foreach ($payload->get('source') as &$source) {
            $this->command->handle(
                [
                    'automation_id' => $automation_id,
                    'url' => $source['url'],

                ]
            );
        }

        return $next($payload);
    }
}
