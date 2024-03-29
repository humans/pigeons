<?php

declare(strict_types=1);

namespace App\Data;

use Hybridly\Support\Data\DataResource;

class SiteData extends DataResource
{
    public static array $authorizations = [];

    public function __construct(
        public int $id,
        public string $name,
        public string $type,
        public string $webroot,
        public ?ServerData $server,
    ) {
    }
}
