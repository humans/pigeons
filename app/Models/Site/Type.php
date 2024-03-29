<?php

declare(strict_types=1);

namespace App\Models\Site;

enum Type: string
{
    case Laravel = 'laravel';

    case Static = 'static';
}
