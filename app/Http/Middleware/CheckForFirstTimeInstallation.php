<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckForFirstTimeInstallation
{
    public function handle(Request $request, Closure $next)
    {
        if (User::count() === 0) {
            return redirect()->route('setup.create');
        }

        return $next($request);
    }
}
