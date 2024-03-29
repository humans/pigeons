<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\SetupCaddyWebServer;
use App\Models\Server;
use App\Models\Site;
use Illuminate\Http\Request;

class SitesController
{
    public function index()
    {
        return hybridly('sites.index');
    }

    public function store(Request $request, Server $server)
    {
        $site = Site::create([
            'server_id' => $server->id,
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'webroot' => $request->input('webroot'),
        ]);

        (new SetupCaddyWebServer($site))->run($server);

        return redirect()->back();
    }
}
