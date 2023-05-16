<?php

namespace App\Commands\Automations;

use App\Models\Automation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class StoreAutomation
{
    public function handle($payload)
    {
        return DB::transaction(callback: static fn () => Automation::query()->create(
            [
                'user_id' => $payload->get('user')->id,
                'name' => $payload->get('name'),
                'frequency' => $payload->get('frequency'),
                'type' => $payload->get('type'),
            ]
        ), attempts: 2,);
    }
}
