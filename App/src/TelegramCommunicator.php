<?php

class TelegramCommunicator extends IncomingDataFormatter {

    private $data;

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
        return new TelegramSource(['chat_id' => $this->data->getChatId(),
            'text' => 'Hi, ' . $this->data->getUserName()]);
    }

}