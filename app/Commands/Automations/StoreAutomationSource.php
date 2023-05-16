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
        //dd($sources->toArray());
        return DB::transaction(
            callback: static fn () =>
            AutomationSource::query()->create(
                $source
            ),
            attempts: 2,
        );
    }
}
