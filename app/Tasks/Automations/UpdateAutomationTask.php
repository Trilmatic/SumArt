<?php

namespace App\Tasks\Automations;

use App\Commands\Automations\StoreAutomation;
use App\Commands\Automations\UpdateAutomation;
use App\Models\Automation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class UpdateAutomationTask
{
    public function __construct(private readonly UpdateAutomation $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $this->command->handle($payload);
        return $next($payload);
    }
}
