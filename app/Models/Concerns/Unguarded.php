<?php

declare(strict_types=1);

namespace App\Models\Concerns;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait Unguarded
{
    public function initializeUnguarded(): void
    {
        static::$unguarded = true;

        $this->guarded = [];
    }
}
