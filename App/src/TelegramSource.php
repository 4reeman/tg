<?php

class TelegramSource implements DataSourceDefinerInterface {

    public $incomingData;

    public function __construct($data) {
        $this->incomingData = $data;
    }

    public function sendMessage() {
        file_put_contents('message.json', json_encode($this->incomingData));
        echo 'successful put';
    }
}