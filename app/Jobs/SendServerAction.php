<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SendServerAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Action $action)
    {
    }

    public function handle(): void
    {
        File::ensureDirectoryExists(
            storage_path('app/scripts')
        );

        File::put(
            $path = storage_path('app/scripts/'.Str::random().'.sh'),
            $this->action->script,
        );

        $this->action->update([
            'started_at' => now(),
        ]);

        $this->action->server->scp(
            $path,
            $script = "{$this->action->server->paths->scripts()}/{$this->action->id}.sh",
        );

        $this->action->update([
            'result'      => $this->action->server->execute("bash {$script}"),
            'status'      => Action\Status::Successful,
            'finished_at' => now(),
        ]);
    }
}
