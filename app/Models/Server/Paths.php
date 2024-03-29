<?php

declare(strict_types=1);

namespace App\Models\Server;

use App\Models\Server;

class Paths
{
    public function __construct(private Server $server)
    {
    }

    public function home(): string
    {
        return $this->server->home_path;
    }

    public function scripts(): string
    {
        return $this->server->home_path.'/.roost';
    }

    public function caddy(): string
    {
        return $this->server->web_server->path;
    }
}
