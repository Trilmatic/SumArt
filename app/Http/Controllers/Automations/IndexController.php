<?php

namespace App\Http\Controllers\Automations;

use App\Http\Requests\AutomationRequest;
use App\Queries\Automations\ListAutomations;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class IndexController
{

    public function __invoke(Request $request)
    {
        $handler = new ListAutomations;
        $automations = $handler->handle($request)->orderBy('updated_at', 'desc')->paginate(15)
            ->appends($request->query());
        return Inertia::render('Automations/Index', [
            'filter' => $request->input('filter'),
            'automations' => $automations
        ]);
    }
}
