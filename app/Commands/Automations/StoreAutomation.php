<?php

namespace App\Commands\Automations;

use App\Models\Automation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class StoreAutomation
{
    public function handle($payload)
    {
        Gate::authorize('create', Automation::class);
        return DB::transaction(callback: static fn () => Automation::create(
            [
                'user_id' => $payload->get('user')->id,
                'name' => $payload->get('name'),
                'frequency' => $payload->get('frequency'),
                'time_at' => $payload->get('time_at'),
                'type' => $payload->get('type'),
            ]
        ), attempts: 2,);
    }
}
