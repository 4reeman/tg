<?php
//singleton!?
class Product1 {

    public function getData() {
//        $http_body = file_get_contents("php://input");  // exploit change! don`t use file_get_contents
//        $data = json_decode($http_body,true, 25, JSON_OBJECT_AS_ARRAY);
        $data = [
            'message' => [
                'from' => [
                    'id' => 'myId'
                ],
                'chat' => [
                    'id' => 'myId'
                ]
            ]
        ];
        return $data;
    }
}