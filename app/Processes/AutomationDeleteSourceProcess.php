<?php

namespace App\Processes;

use App\Processes\Process;
use App\Tasks\Automations\DeleteAutomationSourceTask;
use App\Tasks\Automations\FindAutomationSourceTask;
use App\Tasks\Automations\FindAutomationTask;
use App\Tasks\Automations\LogAutomtionSourceDeletionTask;

final class AutomationDeleteSourceProcess extends Process
{
    protected array $tasks = [
        FindAutomationTask::class,
        FindAutomationSourceTask::class,
        DeleteAutomationSourceTask::class,
        LogAutomtionSourceDeletionTask::class,
    ];
}
