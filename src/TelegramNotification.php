<?php

declare(strict_types=1);

namespace Softok2\TelegramNotification;

use Throwable;
use Illuminate\Support\Facades\Cache;
use Softok2\TelegramNotification\Dtos\TelegramExceptionDto;
use Softok2\TelegramNotification\Jobs\TelegramExceptionJob;

final class TelegramNotification
{
    public function sendException(Throwable $e): void
    {
        $hash = 'exception_'.md5($e->getMessage().$e->getFile().$e->getLine());

        if (cache()->has($hash)) {
            return;
        }

        Cache::remember($hash, now()->addDay(), fn () => true);

        TelegramExceptionJob::dispatch(TelegramExceptionDto::fromThrowable($e));
    }
}
