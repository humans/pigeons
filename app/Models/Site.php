<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Site\Type $type
 */
class Site extends Model
{
    use Unguarded;

    /**
     * @return BelongsTo<Server, self>
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'type' => Site\Type::class,
        ];
    }

    public function root(): string
    {
        return "{$this->server->paths->home()}/{$this->name}";
    }

    public function webroot(): string
    {
        return "{$this->root()}/{$this->webroot}";
    }
}
