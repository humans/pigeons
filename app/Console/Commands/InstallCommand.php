<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\SetupCaddyWebServer;
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
        ]);

        $site = Site::create([
            'server_id' => $server->id,
            'name'      => $this->option('domain'),
            'type'      => Site\Type::Laravel,
        ]);

        (new SetupCaddyWebServer($site))->run($server);
    }
}
