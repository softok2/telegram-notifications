<?php

declare(strict_types=1);

namespace Softok2\TelegramNotification\Commands;

use Illuminate\Console\Command;

final class TelegramNotificationCommand extends Command
{
    public $signature = 'telegram-notifications';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
