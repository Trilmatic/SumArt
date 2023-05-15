<?php

namespace App\Http\Controllers;

use App\Commands\Automations\loadRssSourceXml;
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

    public function checkSource(Request $request)
    {
        $request->validate([
            'source' => 'required|active_url|max:1000',
        ]);

        $source = $request->input('source');
        $loadSource = new loadRssSourceXml();
        $confirm_source = $loadSource->handle($source);

        if (!$confirm_source) return redirect()->back()->withErrors('Not a valid RSS source.');
        return redirect()->back()->with('success', 'RSS source validated.');
    }
}
