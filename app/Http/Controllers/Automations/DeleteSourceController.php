<?php

namespace App\Http\Controllers\Automations;

use App\Processes\AutomationDeleteSourceProcess;
use Illuminate\Http\Request;

final class DeleteSourceController
{
    public function __construct(private readonly AutomationDeleteSourceProcess $process)
    {
    }

    public function __invoke(Request $request, $hash, $id)
    {
        $payload = collect([]);
        $payload->put('hash', $hash);
        $payload->put('id', $id);
        $payload->put('user', $request->user());
        $this->process->run($payload);

        return redirect()->back()->with('success');
    }
}
