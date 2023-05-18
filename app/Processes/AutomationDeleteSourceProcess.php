<?php

namespace App\Processes;

use App\Processes\Process;
use App\Tasks\Automations\DeleteAutomationSourceTask;
use App\Tasks\Automations\FindAutomationSourceTask;
use App\Tasks\Automations\FindAutomationTask;

final class AutomationDeleteSourceProcess extends Process
{
    protected array $tasks = [
        FindAutomationTask::class,
        FindAutomationSourceTask::class,
        DeleteAutomationSourceTask::class,
    ];
}
