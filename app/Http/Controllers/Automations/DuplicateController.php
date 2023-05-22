<?php

namespace App\Http\Controllers\Automations;

use App\Processes\AutomationDuplicateProcess;
use Illuminate\Http\Request;

final class DuplicateController
{
    public function __construct(private readonly AutomationDuplicateProcess $process)
    {
    }

    public function __invoke(Request $request, $hash)
    {
        $payload = collect([]);
        $payload->put('user', $request->user());
        $payload->put('hash', $hash);
        $this->process->run($payload);

        return redirect()->route('automations.index');
    }
}
