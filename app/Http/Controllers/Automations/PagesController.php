<?php

namespace App\Http\Controllers\Automations;

use App\Queries\Automations\ListAutomations;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class PagesController
{

    public function create(Request $request)
    {
        return Inertia::render('Automations/CreateOrEdit', []);
    }

    public function edit(Request $request)
    {
        return Inertia::render('Automations/CreateOrEdit', []);
    }

    public function show(Request $request)
    {
        //return Inertia::render('Automations/CreateOrEdit', []);
    }

    public function index(Request $request)
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
