<?php

include 'PostHook.php';
include 'TelegramSendMessage.php';
include 'DatabaseInfo.php';
include 'TrelloButtonKeybord.php';

class DataFormatter {

    public $data;

    public function __construct() {
        $this->postData();
        $this->sendMessage();
    }

    public function postData() {
        $hook = new PostHook();
        $this->data = $hook->getData();
        echo($this->data);
    }

    public function sendMessage() {
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
            $db->insertData($this->getUserId(), $this->getUserName(), $this->getChatId());
            $response->response('sandMessage', ['chat_id' => $this->getChatId(), 'pls, copy your personal key']);
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'Your Trello Key', 'url' => 'https://trello.com/app-key']
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);
            $trelloKeyLink = [
                'chat_id' => $this->getChatId(),
                'text' => 'I`m need your key to authorize you in trello',
                'reply_markup' => $encodedKeyboard,
            ];
            $response->response('sendMessage', $trelloKeyLink);
        }
        else {
            $personalKey = 'ea3b9632108faebab5ffab2128e103ef';
//            $personalKey = $this->getMessage();
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'trello auth', 'url' => 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' . $personalKey]
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);
            $trelloButton = [
                'chat_id' => $this->getChatId(),
                'text' => 'click here',
                'reply_markup' => $encodedKeyboard,
            ];
            $response->response('sendMessage', $trelloButton);
//            $response->response('sendMessage', ['chat_id' => $this->getChatId(), 'text' => 'Make your choice' . "\xE2\x98\x9D"]);
        }
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
