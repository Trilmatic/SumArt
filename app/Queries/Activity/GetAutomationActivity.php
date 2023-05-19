<?php

namespace App\Queries\Activity;

use App\Models\Automation;

use Spatie\Activitylog\Models\Activity;

final class GetAutomationActivity
{
    public function handle(Automation $automation)
    {
        return Activity::where('subject_type', 'App\Models\Automation')->where('subject_id', $automation->id);
    }
}
