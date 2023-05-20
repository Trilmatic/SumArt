<?php

namespace App\Http\Controllers\Automations;

use App\Models\Automation;
use App\Queries\Automations\FindAutomation;
use App\Queries\Automations\ListAutomations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

final class PagesController
{

    public function create(Request $request)
    {
        Gate::authorize('create', Automation::class);
        return Inertia::render('Automations/CreateOrEdit', []);
    }

    public function edit(Request $request, $hash)
    {
        $handler = new FindAutomation();
        $automation = $handler->handle($hash);
        Gate::authorize('update',  $automation);
        return Inertia::render('Automations/CreateOrEdit', [
            'automation' => $automation
        ]);
    }

    public function show(Request $request, $hash)
    {
        $handler = new FindAutomation();
        $automation = $handler->handle($hash);
        Gate::authorize('view',  $automation);
        return Inertia::render('Automations/Show', [
            'automation' => $automation,
            'activity' => $automation->activity()
        ]);
    }

    public function showById(Request $request, $id)
    {
        $automation = Automation::findOrFail($id);
        return redirect()->route("automations.show", $automation->hash);
    }

    public function index(Request $request)
    {
        $handler = new ListAutomations;
        $automations = $handler->handle($request)->orderBy('updated_at', 'desc')->paginate(10)
            ->appends($request->query());
        return Inertia::render('Automations/Index', [
            'filter' => $request->input('filter'),
            'automations' => $automations
        ]);
    }
}
