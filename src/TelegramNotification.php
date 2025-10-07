<?php

declare(strict_types=1);

namespace Softok2\TelegramNotification;

use Throwable;
use Softok2\TelegramNotification\Dtos\TelegramExceptionDto;
use Softok2\TelegramNotification\Jobs\TelegramExceptionJob;

final class TelegramNotification
{
    public function sendException(Throwable $e): void
    {
        TelegramExceptionJob::dispatch(TelegramExceptionDto::fromThrowable($e));
    }
}
