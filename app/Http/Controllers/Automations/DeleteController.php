<?php

namespace App\Http\Controllers\Automations;

use App\Processes\AutomationDeleteProcess;
use Illuminate\Http\Request;

final class DeleteController
{
    public function __construct(private readonly AutomationDeleteProcess $process)
    {
    }

    public function __invoke(Request $request, $hash)
    {
        $payload = collect([]);
        $payload->put('hash', $hash);
        $payload->put('user', $request->user());
        $this->process->run($payload);

        return redirect()->back()->with('success');
    }
}
