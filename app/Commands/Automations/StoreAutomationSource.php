<?php

namespace App\Commands\Automations;

use App\Models\Automation;
use App\Models\AutomationSource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class StoreAutomationSource
{
    public function handle($source)
    {
        return DB::transaction(
            callback: static fn () =>
            AutomationSource::create(
                $source
            ),
            attempts: 2,
        );
    }
}
