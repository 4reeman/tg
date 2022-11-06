<?php

class TelegramCommunication {

    public $data;
    public $response;
    public $db;

    public function __construct(TelegramOwn $data, SendMessageInterface $response, DbDriver $db) {
        $this->data = $data;
        $this->response = $response;
        $this->db = $db;
    }

    public function communicate() {
        switch ($this->data->getMessage()) {
            case '/start':
                $this->startResponse();
                break;
            case 'trello':
                $this->trelloButtonsRespons();
                break;
        }
    }

    public function startResponse() {
        if($this->data->getUserId() == $this->data->getChatId()) {
            $this->response->send('sendMessage', ['chat_id' => $this->data->getChatId(),
            'text' => 'Sorry, but this bot do not accessible via private chat']);
        }
        else {
            $this->response->send('sendMessage', ['chat_id' => $this->data->getChatId(),
                'text' => 'Hi, ' . $this->data->getUserName()]);

            $tgData = [
                'user_id' => $this->data->getUserId(),
                'chat_id' => $this->data->getChatId()
            ];
            $tgInsertData = [
                'user_id' => $this->data->getUserId(),
                'user_name' => $this->data->getUserName(),
                'chat_id' => $this->data->getChatId()
            ];
            if(!$this->db->reviewData($tgData)) {
                $this->db->insertData($tgInsertData);
            }
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
                'reply_markup' => $encodedKeyboard,
            ];
            $this->response->send('sendMessage', $trelloKeyLink);
        }
    }

    public function trelloButtonsRespons() {
        //create select chat_id where user_id and send button to get otchet
//        $this->response->send('sendMessage', ['chat_id' => $this->data->getUserId(), 'text' => 'Hi']);
    }

}