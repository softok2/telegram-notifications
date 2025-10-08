<?php

declare(strict_types=1);

// config for Softok2/TelegramNotification
return [
    'bot_token' => env('SOFTOK2_TELEGRAM_BOT_TOKEN', 'Your bot token here'),
    'chat_id' => env('SOFTOK2_TELEGRAM_CHAT_ID', 'Your chat ID here'),
];
