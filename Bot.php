<?php

class Bot
{
    private $name;
    private $system_message;
    private $token;
    private $url;

    public function __construct($name, $system_message, $token, $url)
    {
        $this->name = $name;
        $this->system_message = $system_message;
        $this->token = $token;
        $this->url = $url;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSystemMessage()
    {
        return $this->system_message;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
