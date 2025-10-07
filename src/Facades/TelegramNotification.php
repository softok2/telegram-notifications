<?php

declare(strict_types=1);

namespace Softok2\TelegramNotification\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Softok2\TelegramNotification\TelegramNotification
 */
final class TelegramNotification extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Softok2\TelegramNotification\TelegramNotification::class;
    }
}
