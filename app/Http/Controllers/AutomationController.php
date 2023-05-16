<?php

namespace App\Http\Controllers;

use App\Commands\Automations\loadRssSourceXml;
use App\Http\Requests\AutomationRequest;
use App\Http\Requests\SourceRequest;
use Illuminate\Http\Request;
use App\Models\Automation;
use App\Models\AutomationSource;
use Inertia\Inertia;

class AutomationController extends Controller
{
    public function create(Request $request)
    {
        return Inertia::render('Automations/Create', []);
    }

    public function checkSource(SourceRequest $request)
    {
        $source = $request->input('source');
        $loadSource = new loadRssSourceXml();
        $confirm_source = $loadSource->handle($source);

        if (!$confirm_source) return redirect()->back()->withErrors('Not a valid RSS source.');
        return redirect()->back()->with('success', 'RSS source validated.');
    }

    public function store(AutomationRequest $request)
    {
        $user = $request->user();
    }
}
