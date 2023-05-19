<?php

namespace App\Commands\Automations;

use App\Models\Automation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

final class UpdateAutomation
{
    public function handle($payload)
    {
        $automation = $payload->get('automation');
        Gate::authorize('update', $automation);
        return DB::transaction(callback: static fn () => $automation->update(
            [
                'name' => $payload->get('name'),
                'frequency' => $payload->get('frequency'),
                'time_at' => $payload->get('time_at'),
                'type' => $payload->get('type'),
            ]
        ), attempts: 2,);
    }
}
