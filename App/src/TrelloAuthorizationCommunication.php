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
        if($this->db->reviewData(['user_id' => $this->data->getUserId()], true)) {
            $this->db->updateData(['api_key' => $this->data->getApiKey()], ['user_id' => $this->data->getUserId()]);
        }
    }

    public function insertToken() {
        if($this->db->reviewData(['user_id' => $this->data->getUserId()], true)) {
            $this->db->updateData(['personal_token' => $this->data->getPersonalToken()], ['user_id' => $this->data->getUserId()]);
        }
    }
}