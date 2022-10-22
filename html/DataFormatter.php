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
    }

    public function sendMessage() {
        $response = new TelegramSendMessage();
        if ($this->getMessage() == '/start') {
      
            $response->response(['chat_id' => $this->getChatId(), 'text' => 'Hi, ' . $this->getUserName()]);
            $db = new DatabaseInfo();
            $db->insertData($this->getUserId(), $this->getUserName(), $this->getChatId());
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'trello auth', 'url' => 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=ea3b9632108faebab5ffab2128e103ef']
                    ]
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);
            $trelloButton = [
                'chat_id' => $this->getChatId(),
                'text' => 'click here',
                'reply_markup' => $encodedKeyboard,
            ];
            $response->response($trelloButton);
//            $button = new TrelloButtonKeybord();
//            $button->response($this->getChatId(), 'sync trello', 'click the button');
        }
        else {
            $response->response($this->getChatId(), 'trello button');
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
