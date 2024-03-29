<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class FirstTimInstallation
{
    public function handle(Request $request, Closure $next)
    {
        if (User::count() > 0) {
            return redirect()->route('signin.create');
        }

        return $next($request);
    }
}
