<?php

class TrelloAuthorizationService implements InputDataInterface {

    public $data;

    public function __construct() {
        $this->getData();
    }

    public function getData() {
        $http_body = file_get_contents("php://input");  // exploit change! don`t use file_get_contents
        $data = json_decode($http_body,true, 25, JSON_OBJECT_AS_ARRAY);
        $this->data = $data;
    }

    public function getUserId() {
        return $this->data['user_id'];
    }

    public function getApiKey() {
        return $this->data['api_key'];
    }

    public function getPersonalToken() {
        return $this->data['personal_token'];
    }
}