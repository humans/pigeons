<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\ServerData;
use App\Data\SiteData;
use App\Models\Server;
use App\Models\Site;

class ServersController
{
    public function index()
    {
        return hybridly('servers.index', [
            'servers' => ServerData::collect(Server::latest()->get()),
            'links' => [
                'servers_create_path' => route('servers.create'),
            ],
        ]);
    }

    public function show(Server $server)
    {
        return hybridly('servers.show', [
            'server' => ServerData::from($server),
            'sites' => SiteData::collect(
                Site::whereBelongsTo($server)->get(),
            ),
        ]);
    }

    public function create()
    {
        return hybridly('servers.create');
    }
}
