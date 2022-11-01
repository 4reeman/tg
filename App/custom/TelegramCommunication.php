<?php

class TelegramCommunication {

    private $data;
    private $response;
    private $db;

    public function __construct(TelegramOwn $data, SendMessageInterface $response, DbDriver $db) {
        $this->data = $data;
        $this->response = $response;
        $this->db = $db;
    }

    public function communicate() {
        switch ($this->data->getMessage()) {
            case '/start':
                $this->startResponse();
                break;
        }

    }

    private function startResponse() {
        $this->response->send('sendMessage', ['chat_id' => $this->data->getChatId(), 'text' => 'Hi, ' . $this->data->getUserName()]);
    }
}