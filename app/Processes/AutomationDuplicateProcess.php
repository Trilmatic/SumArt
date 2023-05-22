<?php

namespace App\Processes;

use App\Processes\Process;
use App\Tasks\Automations\PrepareAutomationDuplicationRequest;
use App\Tasks\Automations\StoreAutomationTask;
use App\Tasks\Automations\StoreAutomationSourcesTask;
use App\Tasks\Automations\FindAutomationTask;

final class AutomationDuplicateProcess extends Process
{
    protected array $tasks = [
        FindAutomationTask::class,
        PrepareAutomationDuplicationRequest::class,
        StoreAutomationTask::class,
        StoreAutomationSourcesTask::class,
    ];
}
