<?php

namespace App\Http\Controllers\Automations;

use App\Commands\Automations\loadRssSourceXml;
use App\Http\Requests\AutomationRequest;
use App\Http\Requests\SourceRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class CheckSourceController
{

    public function __invoke(SourceRequest $request)
    {
        $source = $request->input('source');
        $loadSource = new loadRssSourceXml();
        $confirm_source = $loadSource->handle($source);

        if (!$confirm_source) return redirect()->back()->withErrors('Not a valid RSS source.');
        return redirect()->back()->with('success', 'RSS source validated.');
    }
}
