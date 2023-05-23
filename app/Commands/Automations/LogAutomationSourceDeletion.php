<?php

namespace App\Commands\Automations;

final class LogAutomationSourceDeletion
{
    public function handle($payload)
    {
        return activity()
            ->causedBy($payload->get('user'))
            ->performedOn($payload->get('automation'))
            ->log('source:deleted');
    }
}
