<?php

namespace App\Http;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Pipeline as FacadesPipeline;

abstract class Process
{
    protected array $tasks = [];

    public function run(object $payload)
    {
        return app(Pipeline::class)->send(passable: $payload,)
            ->through(pipes: $this->tasks,)
            ->thenReturn();
    }
}
