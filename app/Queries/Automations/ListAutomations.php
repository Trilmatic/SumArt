<?php

namespace App\Queries\Automations;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final class ListAutomations
{
    public function handle(Request $request)
    {
        return QueryBuilder::for($request->user()->automations())->allowedFilters(['name']);
    }
}
