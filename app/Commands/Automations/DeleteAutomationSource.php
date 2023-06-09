<?php

namespace App\Commands\Automations;

use App\Models\AutomationSource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

final class DeleteAutomationSource
{
    public function handle($automation, $source)
    {
        Gate::authorize('delete', $automation);
        return DB::transaction(callback: static fn () => $source->delete(), attempts: 2,);
    }
}
