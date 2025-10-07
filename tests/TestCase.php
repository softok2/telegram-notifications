<?php

declare(strict_types=1);

namespace Softok2\TelegramNotification\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Database\Eloquent\Factories\Factory;
use Softok2\TelegramNotification\TelegramNotificationServiceProvider;

final class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Softok2\\TelegramNotification\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/../database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }

    protected function getPackageProviders($app)
    {
        return [
            TelegramNotificationServiceProvider::class,
        ];
    }
}
