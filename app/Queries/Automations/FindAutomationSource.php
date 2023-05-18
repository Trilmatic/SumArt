<?php

namespace App\Queries\Automations;

use App\Models\AutomationSource;

final class FindAutomationSource
{
    public function handle($id)
    {
        $record = AutomationSource::where('id', $id);
        if (!$record->exists()) abort(404);
        return $record->first();
    }
}
