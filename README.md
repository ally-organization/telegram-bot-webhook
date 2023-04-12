# telegram-chatgpt-php

This is a proof of concept to test Telegram integration with ChatGPT through an API call.

## Tokens

1. Create a bot using BotLauncher by following the Telegram documentation or online resources. You'll be done once you have a Telegram bot token.
2. Generate an API token through your account on OpenAI.

## Setup

1. Clone this repository.
2. Run `composer install` to install dependencies.
3. Replace the placeholders in the `.env` file by copying the `.env.example` and replacing the values.
4. Run `php -S localhost:8000` to start the server.
5. Run the `set_webhook.php` file on the server URL to set up the webhook URL to Telegram.
6. Test by sending a message with your bot.