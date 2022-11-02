<?php
 class TrelloOwn implements InputDataInterface {
     public $data;

     public function __construct() {

     }

     public function getData() {
         $http_body = file_get_contents("php://input");  // exploit change! don`t use file_get_contents
         $data = json_decode($http_body,true, 25, JSON_OBJECT_AS_ARRAY);
         $this->data = $data;
     }

     public function getCardId() {
//         return $this->data['message']['chat']['id'];
         return 'CardId';
     }
     public function getBoardId() {
//         return $this->data['message']['from']['id'];
        return 'BoardId';
     }
 }