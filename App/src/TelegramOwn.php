<?php

class TelegramOwn implements InputDataInterface {

    public $data;

    public function getData() {
        $http_body = file_get_contents("php://input");  // exploit change! don`t use file_get_contents
        $data = json_decode($http_body,true, 25, JSON_OBJECT_AS_ARRAY);
        $this->data = $data;
    }

    public function getChatId() {
        return $this->data['message']['chat']['id'];
    }
    public function getUserId() {
        return $this->data['message']['from']['id'];
    }
    public function getUserName() {
        return $this->data['message']['from']['first_name'];
    }
    public function getMessage() {
        return $this->data['message']['text'];
    }
}