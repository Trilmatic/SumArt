<?php

namespace App\Queries\Automations;

use App\Models\Automation;

final class FindAutomation
{
    public function handle($hash)
    {
        return Automation::where('hash', $hash);
    }
}
