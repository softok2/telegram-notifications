<?php

declare(strict_types=1);

namespace Softok2\TelegramNotification\Notifications;

use JsonException;
use Illuminate\Bus\Queueable;
use Laravel\Telescope\Telescope;
use Illuminate\Support\Facades\Log;
use Laravel\Telescope\Storage\EntryModel;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;
use Softok2\TelegramNotification\Dtos\TelegramExceptionDto;

final class TelegramExceptionNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly TelegramExceptionDto $exceptionDto) {}

    public function via($notifiable): array
    {
        return ['telegram'];
    }

    /**
     * @throws JsonException
     */
    public function toTelegram(): TelegramMessage
    {
        $exceptionDto = $this->exceptionDto;

        $content = sprintf(
            "🚨 *%s Exception Alert*\n\n"."*Message:* `%s`\n".
            "*File:* `%s`\n"."*Line:* `%d`\n"."*Date:* %s\n\n",
            config('app.name'),
            str_replace('`', '', $exceptionDto->getMessage()),
            $exceptionDto->getFile(),
            $exceptionDto->getLine(),
            now()->toDateTimeString(),
        );

        $uuid = $this->log($content, $exceptionDto->getTrace());

        $telegramMessage = TelegramMessage::create()
            ->token(config('telegram-notification.bot_token'))
            ->content($content)
            ->options(['parse_mode' => 'Markdown']);

        if ($uuid) {
            $telegramMessage->button('View stack trace', url('/telescope/logs/'.$uuid));
        }

        return $telegramMessage;
    }

    private function log($content, string $trace): ?string
    {
        Log::error($content, ['trace' => $trace]);

        if (! class_exists(Telescope::class)) {
            return null;
        }

        return EntryModel::latest('created_at')->value('uuid');
    }
}
