<?php

namespace App\Queries\Automations;

final class ListAutomations
{
    public function handle($user)
    {
        return $user->automations();
    }
}
