<?php

class TelegramCommunicator extends IncomingDataFormatter {

    public $data;

    public function __construct() {
        $this->data = parent::getDecodedBody();
    }

    public function getChatId() {
        if(!empty($this->data['message']['chat']['id'])) {
            return $this->data['message']['chat']['id'];
        }
        return $this->data['callback_query']['message']['chat']['id'];
    }
    public function getUserId() {
        return $this->data['message']['from']['id'];
    }
    public function getUserName() {
        if(!empty($this->data['message']['from']['first_name'])) {
            return $this->data['message']['from']['first_name'];
        }
        return $this->data['callback_query']['from']['first_name'];
    }
    public function getMessage() {
        return $this->data['message']['text'];
    }
    public function getCallbackData() {
        return $this->data['callback_query']['data'];
    }

    public function getDataSource(): DataSourceDefinerInterface {
//        $response = ['chat_id' => $this->data->getChatId(),
//            'text' => 'Hi, ' . $this->data->getUserName()];
//        return new TelegramSource($response);
        $resp = 'proc';
        return new TelegramSource($resp);
    }

}