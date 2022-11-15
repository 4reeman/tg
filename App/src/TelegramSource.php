<?php

class TelegramSource implements DataSourceDefinerInterface {

    final const TGTOKEN = '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw';
    final const URL = 'https://api.telegram.org/bot' . self::TGTOKEN;

    public $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function sendMessage() {
        file_get_contents(self::URL . '/sendMessage?' . http_build_query($this->message));
    }
}