<?php

Class PostHook {

    public $headers;

    public function getData() {
        $http_body = file_get_contents("php://input");  // exploit change! don`t use file_get_contents
        $this->headers = getallheaders();
        $data = json_decode($http_body,true, 25, JSON_OBJECT_AS_ARRAY);
        return $data;
    }

}