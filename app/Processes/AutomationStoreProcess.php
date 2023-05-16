<?php

namespace App\Processes;

use App\Http\Process;
use App\Tasks\Automations\StoreAutomationSourcesTask;
use App\Tasks\Automations\StoreAutomationTask;

final class AutomationStoreProcess extends Process
{
    protected array $tasks = [
        StoreAutomationTask::class,
        StoreAutomationSourcesTask::class,
    ];
}
