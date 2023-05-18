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
        $frequency = $payload->get('frequency');
        if ($payload->has('time')) {
            $frequency .= "|" . $payload->get('time');
        }
        return DB::transaction(callback: static fn () => Automation::query()->create(
            [
                'user_id' => $payload->get('user')->id,
                'name' => $payload->get('name'),
                'frequency' => $frequency,
                'type' => $payload->get('type'),
            ]
        ), attempts: 2,);
    }
}
