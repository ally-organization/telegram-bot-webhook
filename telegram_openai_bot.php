<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Telegram\Bot\Api;
use GuzzleHttp\Client;

$telegram = new Api($_ENV['TELEGRAM_TOKEN']);
$openaiToken = $_ENV['OPENAI_TOKEN'];

$update = json_decode(file_get_contents('php://input'), true);
$message = $update['message'];
$chatId = $message['chat']['id'];
$text = $message['text'];

if ($text && $chatId) {
    $response = getOpenAIResponse($openaiToken, $text);
    $telegram->sendMessage([
        'chat_id' => $chatId,
        'text' => $response,
    ]);
}

function getOpenAIResponse($token, $query)
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
                'role' => 'user',
                'content' => $query,
            ],
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
