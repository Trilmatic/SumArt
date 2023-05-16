<?php

namespace App\Http\Controllers\Automations;

use App\Http\Requests\AutomationRequest;
use App\Processes\AutomationStoreProcess;
use Illuminate\Contracts\Support\Responsable;
use Inertia\Inertia;

final class StoreController
{
    public function __construct(private readonly AutomationStoreProcess $process)
    {
    }

    public function __invoke(AutomationRequest $request)
    {
        $payload = $request->collect();
        $payload->put('user', $request->user());
        $this->process->run($payload);

        return redirect()->back()->with('success');
    }
}
