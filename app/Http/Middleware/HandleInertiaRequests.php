<?php

namespace App\Http\Middleware;

use App\Queries\Activity\GetUserActivity;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = Auth::user();
        $activity = [];
        if ($user) {
            $activityHandler = new GetUserActivity();
            $activity = $activityHandler->handle($user)->orderBy('created_at', 'desc')->limit(100)->get();
        }
        return array_merge(parent::share($request), [
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'userActivity' => $activity,
        ]);
    }
}
