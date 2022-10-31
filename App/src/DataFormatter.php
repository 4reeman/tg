<?php

include 'PostHook.php';
include 'TelegramSendMessage.php';
include 'DatabaseInfo.php';

class DataFormatter {

    public $data;

    public function __construct() {
        $this->postData();
        $this->sendMessage();
    }

    public function postData() {
        $hook = new PostHook();
        $this->data = $hook->getData();
    }

    public function sendMessage()
    {
        $response = new TelegramSendMessage();
//        $permissions = json_encode(['can_send_message' => 'false']);
//        $par = [
//            'chat_id' => $this->getChatId(),
//            'user_id' => $this->getUserId(),
//            'permissions' => $permissions,
//        ];
//        $response->response('restrictChatMember', $par);
        if ($this->getMessage() == '/start') {
            $response->response('sendMessage', ['chat_id' => $this->getChatId(), 'text' => 'Hi, ' . $this->getUserName()]);
            $db = new DatabaseInfo();
            if (!$db->reviewData($this->getUserId(), $this->getChatId())) {
                $db->insertData($this->getUserId(), $this->getUserName(), $this->getChatId());
            }
            $response->response('sandMessage', ['chat_id' => $this->getChatId(), 'pls, copy your personal key']);
            $keyboard = [
//                'inline_keyboard' => [
//                    [
//                        [
//                            'text' => 'Trello Authorization',
//                            'url' => 'https://server4reema.vps.webdock.cloud/'
////                            'callback_data' => 'bla'
//                        ]
//                    ]
//                ]
                'login_url' => [
                    'url' => 'https://server4reema.vps.webdock.cloud/',
                    'request_write_access' => true
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);
            $trelloKeyLink = [
                'chat_id' => $this->getChatId(),
                'text' => 'Tap this one',
                'reply_markup' => $encodedKeyboard,
            ];
            $response->response('sendMessage', $trelloKeyLink);

        }
        /////////////////////////
//        else {
//                $url = "https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=" . $this->getMessage();
//                $header = get_headers($url);
//                $status_code = $header[0];
//                $response->response('sendMessage', ['chat_id'=>$this->getChatId(), 'text' =>$status_code]);
//                if ($status_code = 'HTTP/1.1 200 OK') {
//                    $this->api_key = $this->getMessage();
//                    $keyboard = [
//                        'inline_keyboard' => [
//                            [
//                                ['text' => 'Your Trello Token', 'url' => $url]
//                            ]
//                        ]
//                    ];
//                    $encodedKeyboard = json_encode($keyboard);
//                    $trelloTokenLink = [
//                        'chat_id' => $this->getChatId(),
//                        'text' => 'I`m need your token to get data from dashboards',
//                        'reply_markup' => $encodedKeyboard,
//                    ];
//                    $response->response('sendMessage', $trelloTokenLink);
//
//                    $url_q = 'https://api.trello.com/1/members/me/boards?key=' . $this->api_key .'&token=' . '1b5ccb13c4da29a0e24e72265d1f5288784712017cadb158b65920d1c85980b1';
//                    $header = get_headers($url_q);
//                    $status_code = $header[0];
//                    $response->response('sendMessage', ['chat_id'=>$this->getChatId(), 'text' =>$status_code]);
//                    $board = 'https://api.trello.com/1/members/me/boards?fields=name&' . $this->api_key .'&token=' . '1b5ccb13c4da29a0e24e72265d1f5288784712017cadb158b65920d1c85980b1';
//                    $header = get_headers($url_q);
//                    $status_code = $header[0];
//                    $response->response('sendMessage', ['chat_id'=>$this->getChatId(), 'text' =>$board]);
//            }
    //}
        ///////////////////////////
//            $personalKey = 'ea3b9632108faebab5ffab2128e103ef';
////            $personalKey = $this->getMessage();
//            $keyboard = [
//                'inline_keyboard' => [
//                    [
//                        ['text' => 'trello auth', 'url' => 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' . $personalKey]
//                    ]
//                ]
//            ];
//            $encodedKeyboard = json_encode($keyboard);
//            $trelloButton = [
//                'chat_id' => $this->getChatId(),
//                'text' => 'click here',
//                'reply_markup' => $encodedKeyboard,
//            ];
//            $response->response('sendMessage', $trelloButton);
//            $response->response('sendMessage', ['chat_id' => $this->getChatId(), 'text' => 'Make your choice' . "\xE2\x98\x9D"]);
    }

    protected function getChatId() {
        return $this->data['message']['chat']['id'];
    }
    protected function getUserId() {
        return $this->data['message']['from']['id'];
    }
    protected function getUserName() {
        return $this->data['message']['from']['first_name'];
    }
    protected function getMessage() {
        return $this->data['message']['text'];
    }

}
