<?php

class Director {
    private $builder;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function TrelloMethods()
    {
        $this->builder->TrelloDashboard();
        $this->builder->TrelloCards();
    }

    public function TelegramMethods()
    {
        $this->builder->TelegramChatId();
        $this->builder->TelegramUserId();
    }

    public function WebDockMethods()
    {
        $this->builder->WebDockKey();
        $this->builder->WebDockToken();
    }
}