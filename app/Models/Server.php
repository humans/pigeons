<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\Unguarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Process;

/**
 * @property array<string, mixed> $meta
 */
class Server extends Model
{
    use Unguarded;

    /**
     * @var array<string, mixed>
     */
    protected $attributes = [
        'ssh_port' => 22,
    ];

    /**
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'ssh_public_key' => 'encrypted',
            'ssh_key_pair' => 'encrypted:array',
            'sudoer_username' => 'encrypted',
            'sudoer_password' => 'encrypted',
            'web_server' => 'object',
            'meta' => 'object',
        ];
    }

    public function paths(): Attribute
    {
        return new Attribute(
            get: fn () => new Server\Paths($this),
        );
    }

    public function sshIdentityFilePath(): string
    {
        return storage_path("app/server-ssh-keys/{$this->id}");
    }

    public function scp(string $from, string $to): void
    {
        Process::run(
            sprintf(
                'scp -i %s -P %d %s %s@%s:%s',
                $this->sshIdentityFilePath(),
                $this->ssh_port,
                $from,
                $this->sudoer_username,
                $this->public_ip_address,
                $to
            )
        )->throw();
    }

    public function execute(string $command): string
    {
        return Process::run(
            sprintf(
                'ssh -i %s -p %d %s@%s "%s"',
                $this->sshIdentityFilePath(),
                $this->ssh_port,
                $this->sudoer_username,
                $this->public_ip_address,
                $command,
            )
        )->throw()->output();
    }
}
