<?php

declare(strict_types=1);

namespace App\Host;

use App\Models\Server;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Fluent;

class GenerateSshKeys
{
    public function __invoke(Server $server)
    {
        File::ensureDirectoryExists(
            storage_path('app/server-ssh-keys'),
        );

        Process::run(
            sprintf(
                /**
                 * -C comment
                 * -f output filename (name|name.pub)
                 * -t cryptography
                 * -N new passphrase
                 * <<< y This overwrites the existing file
                 */
                'ssh-keygen -C "roost@humans.ph" -t rsa -b 4096 -N %s -f %s',
                escapeshellarg(''),
                $path = $server->sshIdentityFilePath(),
            )
        )->throw()->output();

        return new Fluent([
            'public'  => File::get("{$path}.pub"),
            'private' => File::get("{$path}"),
        ]);
    }
}
