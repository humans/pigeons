<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Host\GenerateSshKeys;
use App\Models\Server;
use App\Models\Site;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'install {--domain=} {--ip=} {--password=}';

    protected $description = 'Command description';

    public function handle(): void
    {
        $server = Server::create([
            'name'              => 'roost',
            'sudoer_username'   => 'roost',
            'sudoer_password'   => $this->option('password'),
            'home_path'         => '/home/roost',
            'public_ip_address' => $this->option('ip'),

            'web_server' => [
                'driver' => 'caddy',
                'path'   => '/etc/caddy',
            ],

            'meta' => [],
        ]);

        $keys = (new GenerateSshKeys)($server);

        $server->update([
            'public_key'  => $keys->public,
            'private_key' => $keys->private,
        ]);

        Site::create([
            'server_id' => $server->id,
            'name'      => $this->option('domain'),
            'type'      => Site\Type::Laravel,
            'webroot'   => '/home/roost/'.$this->option('domain').'/public',
        ]);
    }
}
