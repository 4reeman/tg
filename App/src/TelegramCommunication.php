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
        $getBoards = file_get_contents("https://api.trello.com/1/members/me/boards?fields=name,url&key=ea3b9632108faebab5ffab2128e103ef&token=6a7c621b92d4d7e0edad96fcfaeefdade788c459ae91a82b957e5c0e565b4fa4");
        $arrboards = json_decode($getBoards, true);
        $boards = [];
        foreach ($arrboards as $key=>$value) {
            $this->getLists($value['id']);
            array_push($boards, $value['id']);
        }
        return $boards;


    }

    public function getLists($board_id) {
        $getlists = file_get_contents("https://api.trello.com/1/boards/$board_id/lists?fields=name,url&key=ea3b9632108faebab5ffab2128e103ef&token=6a7c621b92d4d7e0edad96fcfaeefdade788c459ae91a82b957e5c0e565b4fa4");
        $arrlists = json_decode($getlists, true);
        $result = [];
        foreach ($arrlists as $key=>$value) {
            array_push($result, $value['name']);
        }
        $this->response->send('sendMessage', ['chat_id' => $this->data->getChatId(), 'text' => implode($result)]);
    }

}