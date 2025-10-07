<?php

declare(strict_types=1);

namespace Softok2\TelegramNotification;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Softok2\TelegramNotification\Commands\TelegramNotificationCommand;

final class TelegramNotificationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('telegram-notifications')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_telegram_notifications_table')
            ->hasCommand(TelegramNotificationCommand::class);
    }
}
