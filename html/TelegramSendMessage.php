<?php

Class TelegramSendMessage {

    public $connection;

    final const TGTOKEN = '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw';
    final const URL = 'https://api.telegram.org/bot' . self::TGTOKEN . '/sendMessage?';

    public function response($id, $message) {
            $response = [
                'chat_id' => $id,
                'text' => $message,
            ];

        file_get_contents(self::URL . http_build_query($response));
    }



}
