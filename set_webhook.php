<?php

// Load Composer's autoloader
require 'vendor/autoload.php';

// Load .env file
if (getenv('APP_ENV') === 'development') {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

use Telegram\Bot\Api;

require_once 'Bot.php';
require_once 'bots.php';

$serverUrl = $_ENV['SERVER_URL'] . '/telegram_openai_bot.php'; // Replace with your environment variable name

foreach ($bots as $bot) {
    $telegram = new Api($bot->getToken());
    $result = $telegram->setWebhook([
        'url' => $serverUrl . '?bot=' . urlencode($bot->getName()),
    ]);

    if ($result) {
        echo $bot->getName() . " webhook was set successfully!\n";
    } else {
        echo "Error setting the " . $bot->getName() . " webhook!\n";
    }
}
