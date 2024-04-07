<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Data\SecurityData;
use App\Data\SharedData;
use App\Data\UserData;
use Hybridly\Http\Middleware;

class HandleHybridRequests extends Middleware
{
    public function share(): SharedData
    {
        return SharedData::from([
            'security' => [
                'user' => UserData::optional(auth()->user())
            ]
        ]);
    }
}
