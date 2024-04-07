<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Server $server
 * @property Action\Status $status
 * @mixin IdeHelperAction
 */
class Action extends Model
{
    use Unguarded;

    /**
     * @var array<string, mixed>
     */
    protected $attributes = [
        'status' => Action\Status::Queued,
    ];

    /**
     * @return BelongsTo<Server, self>
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }

    /**
     * @return BelongsTo<User, self>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'status'      => Action\Status::class,
            'started_at'  => 'immutable_datetime',
            'finished_at' => 'immutable_datetime',
        ];
    }
}
