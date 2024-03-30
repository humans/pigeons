<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Host\GenerateSshKeys;
use App\Models\Server;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        collect(File::files(storage_path('app/server-ssh-keys')))->each(function (\SplFileInfo $file) {
            File::delete($file->getPathname());
        });

        // User::create([
        //     'name' => 'Jaggy Gauran',
        //     'email' => 'jaggy@humans.ph',
        //     'password' => 'password',
        // ]);

        $server = Server::create([
            'name'              => 'asteroid-b612',
            'public_ip_address' => '192.168.100.9',
            'sudoer_username'   => 'jaggy',
            'sudoer_password'   => Str::random(),
            'home_path'         => '/Users/jaggy',

            'web_server' => [
                'path' => '/Users/jaggy/.caddy',
            ],

            'meta' => [],
        ]);

        $keys = (new GenerateSshKeys)($server);

        $server->update([
            'public_key'  => $keys->public,
            'private_key' => $keys->private,
        ]);
    }
}
