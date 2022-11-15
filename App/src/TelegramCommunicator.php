<?php

class TelegramCommunicator extends IncomingDataFormatter {

    public $data;
    public mixed $response;

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

    public function communicate() {
        switch ($this->data->getMessage()) {
            case '/start':
                $this->startResponse();
                break;
        }

    }

    public function startResponse() {
            $keyboard = [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Trello Authorization',
                            'login_url' => [
                                'url' => 'https://server4reema.vps.webdock.cloud/index_trello.php',
                                'request_write_access' => true,
                                'forward_text' => 'Login (forwarded)'
                            ]
                        ]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);
            $trelloKeyLink = [
                'chat_id' => $this->data->getChatId(),
                'text' => 'You need to connect your Telegram account ' .
                    'with our server to use the functionality of this bot in full',
                'reply_markup' => $encodedKeyboard
            ];
            $this->response = $trelloKeyLink;
    }

    public function getDataSource(): DataSourceDefinerInterface {
        return new TelegramSource($this->response);
    }

}