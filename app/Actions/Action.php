<?php

declare(strict_types=1);

namespace App\Actions;

use App\Jobs\SendServerAction;
use App\Models\Action as ActionModel;
use App\Models\Server;
use Illuminate\Support\Facades\Auth;

abstract class Action
{
    abstract public function script(): string;

    public function run(Server $server): void
    {
        $action = ActionModel::create([
            'user_id' => Auth::user()->id,
            'server_id' => $server->id,
            'script' => $this->script(),
        ]);

        SendServerAction::dispatchSync($action);
    }
}
