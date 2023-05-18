<?php

namespace App\Processes;

use App\Processes\Process;
use App\Tasks\Automations\DeleteAutomationTask;
use App\Tasks\Automations\DeleteAutomationSourcesTask;
use App\Tasks\Automations\FindAutomationTask;

final class AutomationDeleteProcess extends Process
{
    protected array $tasks = [
        FindAutomationTask::class,
        DeleteAutomationSourcesTask::class,
        DeleteAutomationTask::class,
    ];
}
