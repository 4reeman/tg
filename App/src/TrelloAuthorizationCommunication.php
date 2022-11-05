<?php

class TrelloAuthorizationCommunication {

    public $data;
    public $response;
    public $db;

    public function __construct(TrelloAuthorizationService $data, SendMessageInterface $response, DbDriver $db) {
        $this->data = $data;
        $this->response = $response;
        $this->db = $db;
    }

    public function insertKey() {
        if($this->db->reviewData($this->data->getUserId())) {
            $this->db->updateData();
        }
    }
}