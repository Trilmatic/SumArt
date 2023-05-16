<?php

namespace App\Http\Controllers\Automations;

use App\Http\Requests\AutomationRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class CreateController
{

    public function __invoke(Request $request)
    {
        return Inertia::render('Automations/Create', []);
    }
}
