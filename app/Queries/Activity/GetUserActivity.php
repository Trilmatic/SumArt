<?php

namespace App\Queries\Activity;

use App\Models\User;

use Spatie\Activitylog\Models\Activity;

final class GetUserActivity
{
    public function handle(User $user)
    {
        return Activity::where('causer_type', 'App\Models\User')->where('causer_id', $user->id);
    }
}
