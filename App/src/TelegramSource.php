<?php

class TelegramSource implements DataSourceDefinerInterface {

    final const TGTOKEN = '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw';
    final const URL = 'https://api.telegram.org/bot' . self::TGTOKEN;

    private $message;

    public function __construct($message) {
        $this->message = $message;
        file_put_contents('checkout.json', json_encode($message));
    }

    public function sendMessage() {
        echo 'send';
        $response = ['chat_id' => '-1001658519019',
            'text' => 'Hi, private message'];
        file_get_contents(self::URL . '/sendMessage?' . http_build_query($response));
    }
}