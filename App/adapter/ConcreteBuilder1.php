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
        return 'Trello Board, ';
    }

    public function TrelloCard()
    {
        return 'Trello Card';
    }

    public function TelegramChatId()
    {
        return $this->product->getData()['message']['chat']['id'];
    }

    public function TelegramUserId()
    {
        return $this->product->getData()['message']['from']['id'];
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