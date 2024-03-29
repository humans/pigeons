<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SigninController
{
    public function create()
    {
        return hybridly('signin.create');
    }

    public function store(Request $request)
    {
        if (! $user = User::where('email', $request->string('email')->toString())->first()) {
            throw ValidationException::withMessages([
                'email' => "The email address doesn't exist in our records.",
            ]);
        }

        if (! Hash::check($request->string('password')->toString(), $user->password)) {
            throw ValidationException::withMessages([
                'email' => "The password doesn't match the email address.",
            ]);
        }

        Auth::login($user);

        return redirect()->route('home.index');
    }
}
