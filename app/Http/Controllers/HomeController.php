<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\ServerData;
use App\Models\Server;

class HomeController
{
    public function index()
    {
        return hybridly('home.index', [
            'servers' => ServerData::collect(
                Server::latest()->get(),
            ),
        ]);
    }
}
