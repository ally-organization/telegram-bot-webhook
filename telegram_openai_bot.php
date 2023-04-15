<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Telegram\Bot\Api;
use GuzzleHttp\Client;

require_once 'Bot.php';
require_once 'bots.php';

$botName = $_GET['bot'];
$bot = null;

foreach ($bots as $botObject) {
    if ($botObject->getName() === $botName) {
        $bot = $botObject;
        break;
    }
}

if (!$bot) {
    echo "Invalid bot name!";
    exit;
}

$telegram = new Api($bot->getToken());
$openaiToken = $_ENV['OPENAI_TOKEN'];

$update = json_decode(file_get_contents('php://input'), true);
$message = $update['message'];
$chatId = $message['chat']['id'];
$text = $message['text'];

if ($text && $chatId) {
    $response = getOpenAIResponse($bot->getSystemMessage(), $openaiToken, $text);
    $telegram->sendMessage([
        'chat_id' => $chatId,
        'text' => $response,
    ]);
}

function getOpenAIResponse($systemMessage, $token, $query)
{
    $client = new Client([
        'base_uri' => 'https://api.openai.com',
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ],
    ]);

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'system',
                'content' => $systemMessage,
            ],
            [
                'role' => 'user',
                'content' => $query,
            ]
        ],
    ];

    $response = $client->post('/v1/chat/completions', [
        'json' => $data,
    ]);

    $responseBody = json_decode($response->getBody(), true);
    $choices = $responseBody['choices'];

    if (!empty($choices)) {
        return $choices[0]['message']['content'];
    }

    return 'Sorry, I could not generate a response.';
}
