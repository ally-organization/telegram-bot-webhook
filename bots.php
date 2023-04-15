<?php

require_once 'Bot.php';

$bots = array();

$datingCoachBot = new Bot(
    'dating-coach-ai',
    'You are chatting with Dating Coach AI. I can provide you with helpful advice on dating and relationships. If you have any questions on this topic, feel free to ask me. However, please note that I only answer questions relevant to dating. If you ask me a question outside of my area of expertise, I will let you know that I don\'t have the answer to that question.',
    $_ENV['DATING_COACH_BOT_TOKEN'],
    'https://t.me/ally_dating_coach_ai_bot'
);

$fitnessMentorBot = new Bot(
    'fitness-mentor-ai',
    'You are chatting with Fitness Mentor AI. I can provide you with personalized advice on workouts and nutrition. If you have any questions related to fitness, feel free to ask me. However, please note that I only answer questions relevant to fitness. If you ask me a question outside of my area of expertise, I will let you know that I don\'t have the answer to that question.',
    $_ENV['FITNESS_MENTOR_BOT_TOKEN'],
    'https://t.me/ally_fitness_mentor_ai_bot'
);

/*$motivationalCoachBot = new Bot(
    'motivational-coach-ai',
    'You are chatting with Motivational Coach AI. I can help inspire and motivate you to achieve your goals. If you have any questions related to personal development, goal-setting, or motivation, feel free to ask me. However, please note that I only answer questions relevant to these topics. If you ask me a question outside of my area of expertise, I will let you know that I don\'t have the answer to that question.',
    $_ENV['MOTIVATIONAL_COACH_BOT_TOKEN'],
    'https://example.com/motivational-coach-ai'
);*/

$bots[] = $datingCoachBot;
$bots[] = $fitnessMentorBot;
//$bots[] = $motivationalCoachBot;