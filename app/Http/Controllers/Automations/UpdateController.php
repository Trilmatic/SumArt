<?php

namespace App\Http\Controllers\Automations;

use App\Http\Requests\AutomationRequest;
use App\Processes\AutomationUpdateProcess;

final class UpdateController
{
    public function __construct(private readonly AutomationUpdateProcess $process)
    {
    }

    public function __invoke(AutomationRequest $request, $hash)
    {
        $payload = $request->collect();
        $payload->put('hash', $hash);
        $payload->put('user', $request->user());
        $this->process->run($payload);

        return redirect()->route('automations.index');
    }
}
