<?php

declare(strict_types=1);

namespace App\Models\Action;

enum Status: string
{
    case Successful = 'successful';

    case Failed = 'failed';

    case Queued = 'queued';

    case Processing = 'processing';
}
