<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Telegram\Bot\Api;

$telegram = new Api(getenv('TELEGRAM_BOT_TOKEN'));
$result = $telegram->setWebhook([
    'url' => 'https://SERVER_URL/telegram_openai_bot.php', // Replace with your server URL and path to the file
]);

if ($result) {
    echo "Webhook was set successfully!";
} else {
    echo "Error setting the webhook!";
}
