<?php

class ConcreteBuilder1 implements Builder {

    private $product;

    public function __construct() {
        $this->reset();
    }

    public function reset() {
        $this->product = new Product1();
    }

    public function TrelloDashboard()
    {
        echo 'Trello Board, ';
    }

    public function TrelloCard()
    {
        echo 'Trello Card';
    }

    public function TelegramChatId()
    {
        echo 'TelegramChatId, ';
    }

    public function TelegramUserId()
    {
        echo 'TelegramUserId';
    }

    public function WebDockKey()
    {
        // TODO: Implement WebDockKey() method.
    }

    public function WebDockToken()
    {
        // TODO: Implement WebDockToken() method.
    }

    public function getProduct(): Product1
    {
        $result = $this->product;
        $this->reset();

        return $result;
    }

}