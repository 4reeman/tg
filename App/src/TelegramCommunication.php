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
        if(empty($this->data->getCallbackData())) {
            switch ($this->data->getMessage()) {
                case '/start':
                    $this->startResponse();
                    break;
                case 'trello':
                    $this->trelloButtonsRespons();
                    break;
            }
        }
        else {
//            switch ($this->data->getCallbackData()) {
//                case '/report':
                    $this->trelloGetReport();
//                    break;
//            }
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
            if(!$this->db->reviewData($tgData, true)) {
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
                    ],
                ],
                'one_time_keyboard' => true,
            ];
            $encodedKeyboard = json_encode($keyboard);
            $trelloKeyLink = [
                'chat_id' => $this->data->getChatId(),
                'text' => 'You need to connect your Telegram account ' .
                    'with our server to use the functionality of this bot in full',
                'reply_markup' => $encodedKeyboard
            ];
            $this->response->send('sendMessage', $trelloKeyLink);
        }
    }

    public function trelloButtonsRespons() {
        $chat_id = $this->db->selectData('chat_id', 'user_id=?', $this->data->getUserId());
        $keyboard = [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Report',
                        'callback_data' => '/report'
                    ]
                ]
            ],
        ];
        $encodedKeyboard = json_encode($keyboard);
        $trelloGetReport = [
            'chat_id' => $chat_id,
            'text' => 'Authorization successful',
            'reply_markup' => $encodedKeyboard
        ];
        $this->response->send('sendMessage', $trelloGetReport);
    }

    public function trelloGetReport() {
//        $get = file_get_contents("https://api.trello.com/1/members/me/boards?fields=name,url&key=ea3b9632108faebab5ffab2128e103ef&token=6a7c621b92d4d7e0edad96fcfaeefdade788c459ae91a82b957e5c0e565b4fa4");
        $getlis = file_get_contents("https://api.trello.com/1/boards/6351ebc9c751fa01e82f1390/lists?fields=name,url&key=ea3b9632108faebab5ffab2128e103ef&token=6a7c621b92d4d7e0edad96fcfaeefdade788c459ae91a82b957e5c0e565b4fa4");
        $getlist = json_encode($getlis);
        $arr = json_decode($getlist,true, 25, JSON_OBJECT_AS_ARRAY);
//        $lists = [];
//        foreach($arr as $key => $value) {
//            array_push($lists, $value['name']);
//        }
//        $result = implode($lists);
//        $this->response->send('sendMessage', ['chat_id' => $this->data->getChatId(), 'text' => strval($get)]);
        $file = $arr[0]['name'];
//        file_put_contents('arr.txt', strval($file));
        file_put_contents('arr1.txt', strval(10));
        $this->response->send('sendMessage', ['chat_id' => $this->data->getChatId(), 'text' => 'bla']);
    }

}