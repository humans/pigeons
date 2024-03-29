<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Site;

class SetupCaddyWebServer extends Action
{
    public function __construct(private Site $site)
    {
    }

    public function script(): string
    {
        return view('scripts.caddy.install', [
            'site' => $this->site,
        ])->render();
    }
}
