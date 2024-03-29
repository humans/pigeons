<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SetupController
{
    public function create()
    {
        return hybridly('setup.create', [
            'links' => [
                'store_path' => route('setup.store'),
            ],
        ]);
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return redirect()->route('signin.create');
    }
}
