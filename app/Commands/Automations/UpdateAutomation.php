<?php

namespace App\Commands\Automations;

use App\Models\Automation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

final class UpdateAutomation
{
    public function handle($payload)
    {
        $automation = $payload->get('automation');
        Gate::authorize('update', $automation);
        $frequency = $payload->get('frequency');
        if ($payload->has('time')) {
            $frequency .= "|" . $payload->get('time');
        }
        return DB::transaction(callback: static fn () => Automation::query()->where('id', $automation->id)->update(
            [
                'name' => $payload->get('name'),
                'frequency' => $frequency,
                'type' => $payload->get('type'),
            ]
        ), attempts: 2,);
    }
}
