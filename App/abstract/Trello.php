<?php

class Trello implements Hook {

    public $data;

    public function getData(): void
    {
        $http_body = file_get_contents("php://input");  // exploit change! don`t use file_get_contents
        $data = json_decode($http_body,true, 25, JSON_OBJECT_AS_ARRAY);
        $this->data = $data;
    }

    public function getId() {
        return $this->data['user']['dashboard'];
    }

}