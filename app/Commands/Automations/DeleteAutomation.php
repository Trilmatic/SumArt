<?php

namespace App\Commands\Automations;

use App\Models\Automation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

final class DeleteAutomation
{
    public function handle($payload)
    {
        $automation = $payload->get('automation');
        Gate::authorize('delete', $automation);
        return DB::transaction(callback: static fn () => Automation::query()->where('id', $automation->id)->delete(), attempts: 2,);
    }
}
