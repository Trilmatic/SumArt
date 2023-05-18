<?php

namespace App\Queries\Automations;

use App\Models\Automation;

final class FindAutomation
{
    public function handle($hash)
    {
        $record = Automation::where('hash', $hash)->with('sources');
        if (!$record->exists()) abort(404);
        return $record->first();
    }
}
