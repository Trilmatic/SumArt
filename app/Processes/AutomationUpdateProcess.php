<?php

namespace App\Processes;

use App\Processes\Process;
use App\Tasks\Automations\FindAutomationTask;
use App\Tasks\Automations\StoreAutomationSourcesTask;
use App\Tasks\Automations\UpdateAutomationTask;

final class AutomationUpdateProcess extends Process
{
    protected array $tasks = [
        FindAutomationTask::class,
        UpdateAutomationTask::class,
        StoreAutomationSourcesTask::class,
    ];
}
