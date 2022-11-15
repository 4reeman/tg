<?php

class TelegramSource implements DataSourceDefinerInterface {

    final const TGTOKEN = '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw';
    final const URL = 'https://api.telegram.org/bot' . self::TGTOKEN;

//    public $message;

//    public function __construct($message) {
//        $this->message = $message;
//    }
    protected function getDecodedBody() {
        $http_body = file_get_contents("php://input");
        $data = json_decode($http_body,true, 25, JSON_OBJECT_AS_ARRAY);
        return $data;
    }
    public function sendMessage() {
        echo 'send';

        $response = ['chat_id' => '-1001658519019',
            'text' => implode($this->getDecodedBody())];
        file_get_contents(self::URL . '/sendMessage?' . http_build_query($response));
    }
}