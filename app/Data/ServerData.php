<?php

declare(strict_types=1);

namespace App\Data;

use Hybridly\Support\Data\DataResource;

class ServerData extends DataResource
{
    public static array $authorizations = [];

    public function __construct(
        public int $id,
        public string $name,
        public string $public_ip_address,
        public string $ssh_port,
        public string $public_key,
    ) {
    }
}
