<?php

class TelegramCommunicator extends IncomingDataFormatter {

    public $data;
    public $response;
    public $db;

    public function __construct(DbDriver $db) {
        $this->data = parent::getDecodedBody();
        $this->db = $db;
        $this->communicate();
    }

    public function getDataSource(): DataSourceDefinerInterface {
        return new TelegramSource($this->response);
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
        if(!empty($this->data['message']['text'])) {
            return $this->data['message']['text'];
        }
        return $this->data['callback_query']['data'];
    }

    public function communicate() {

        if($this->getUserId() == $this->getChatId()) {
            $respons = [
                'chat_id' => $this->getChatId(),
                'text' => 'Sorry, but this bot do not accessible via private chat'
            ];
            $this->response = $respons;
        }

        switch ($this->getMessage()) {
            case '/start':
                $this->initUser();
                $this->startCommand();
                break;
        }
    }

    public function initUser() {
//        $tgData = [
//            'user_id' => $this->getUserId(),
//            'chat_id' => $this->getChatId()
//        ];
//        $tgInsertData = [
//            'user_id' => $this->data->getUserId(),
//            'user_name' => $this->data->getUserName(),
//            'chat_id' => $this->data->getChatId()
//        ];
//        if(!$this->db->selectData($tgData, true)) {
//            $this->db->insertData($tgInsertData);
//        }
        $greeting = [
            'chat_id' => $this->getChatId(),
            'text' => 'Hi, ' . $this->getUserName()
        ];
        $this->response = $greeting;
    }

    public function startCommand() {
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
                ],
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);
        $trelloKeyLink = [
            'chat_id' => $this->getChatId(),
            'text' => 'You need to connect your Telegram account ' .
                'with our server to use the functionality of this bot in full',
            'reply_markup' => $encodedKeyboard
        ];
        $this->response = $trelloKeyLink;
    }

}