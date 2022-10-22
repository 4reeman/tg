<?php

include 'PostHook.php';
include 'TelegramSendMessage.php';
include 'DatabaseInfo.php';

class DataFormatter {

    public $data;

    public function __construct() {
        $this->postData();
        $this->sendMessage();
    }

    public function postData() {
        $hook = new PostHook();
        $this->data = $hook->getData();
    }

    public function sendMessage() {
        $response = new TelegramSendMessage();
        if ($this->getMessage() == '/start') {
            $response->response($this->getChatId(), 'Hi, ' . $this->getUserName());
            $db = new DatabaseInfo();
            $db->insertData($this->getUserId(), $this->getUserName(), $this->getChatId());
        }
        else {
            $response->response($this->getChatId(), 'trello button');
        }
    }

    protected function getChatId() {
        return $this->data['message']['chat']['id'];
    }
    protected function getUserId() {
        return $this->data['message']['from']['id'];
    }
    protected function getUserName() {
        return $this->data['message']['from']['first_name'];
    }
    protected function getMessage() {
        return $this->data['message']['text'];
    }

}