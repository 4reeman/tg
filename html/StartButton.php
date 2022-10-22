<?php
//include 'TelegramSendMessage.php';
class StartButton {
    final const TGTOKEN = '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw';
    final const URL = 'https://api.telegram.org/bot' . self::TGTOKEN . '/sendMessage?';

    public function response($chat_id, $button_message, $message) {
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => $button_message, 'url' => 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=ea3b9632108faebab5ffab2128e103ef']
                ]
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);
        $parameters = [
            'chat_id' => $chat_id,
            'text' => $message,
            'reply_markup' => $encodedKeyboard,
        ];
        file_get_contents(self::URL . http_build_query($parameters));
    }
}