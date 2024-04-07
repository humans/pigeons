<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;
use App\Data\UserData;

class SecurityData extends Data
{
    public function __construct(
        public readonly ?UserData $user,
    ) {
    }
}
