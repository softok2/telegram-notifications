<?php

namespace Softok2\TelegramNotification\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Softok2\TelegramNotification\Dtos\TelegramExceptionDto;
use Softok2\TelegramNotification\Notifications\TelegramExceptionNotification;
use Throwable;

class TelegramExceptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly TelegramExceptionDto $exceptionDto) {}

    public function handle(): void
    {
        try {
            Notification::route('telegram', config('services.telegram-bot-api.chat_id'))
                ->notify(new TelegramExceptionNotification(
                    $this->exceptionDto,
                ));
        } catch (Throwable $exception) {
            Log::error('Failed to send Telegram exception notification: '.$exception->getMessage(), $exception->getTrace());
        }
    }
}
