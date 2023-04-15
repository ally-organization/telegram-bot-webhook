# telegram-bot-webhook

Initially a proof of concept to test Telegram integration with ChatGPT through an API call. It still is, but initially it was supporting just one bot. Now it has been updated to support multiple bots.

The way it works is in the `bots.php` file, you can configure the bots you want, giving them a name, system message, and URL. Then, calling the `set_webhook.php` file will go through each bot and set the correct URL.

Once the bot calls that URL, dynamically it contains a bot name, it then uses that to fetch the system message to pass to the bot and make it steered in that direction.

## Tokens needed

You need a Telegram bot and OpenAI token for this to work.

1. Create a bot using BotLauncher by following the Telegram documentation or online resources. You'll be done once you have a Telegram bot token.
2. Generate an API token through your account on OpenAI.

## Setup

1. Clone this repository.
2. Run `composer install` to install dependencies.
3. Replace the placeholders in the `.env` file by copying the `.env.example` and replacing the values. This includes setting a server URL, token for OpenAI, and a token for each Telegram bot.
4. Run `php -S localhost:8000` to start the server.
5. Run the `set_webhook.php` file on the server URL to set up the webhook URL for all configured bots.
6. Test by sending a message with your bot.
