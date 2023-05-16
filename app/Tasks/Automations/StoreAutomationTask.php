<?php

namespace App\Tasks\Automations;

use App\Commands\Automations\StoreAutomation;
use App\Models\Automation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class StoreAutomationTask
{
    public function __construct(private readonly StoreAutomation $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        //dd($payload);
        $automation = $this->command->handle($payload);
        $payload->put('automation', $automation);
        return $next($payload);
    }
}
