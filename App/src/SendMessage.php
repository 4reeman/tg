<?php

Class SendMessage implements SendMessageInterface {

    final const TGTOKEN = '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw';
    final const URL = 'https://api.telegram.org/bot' . self::TGTOKEN;

    public function send($method, $parameters) {
        file_get_contents(self::URL . '/' . $method . '?' . http_build_query($parameters));
    }
}