<?php

namespace App\Queries\Activity;

use Spatie\Activitylog\Models\Activity;

final class GetAllActivity
{
    public function handle()
    {
        return Activity::all();
    }
}
