<?php

include '../src/InputDataInterface.php';
include '../src/SendMessageInterface.php';
include '../src/DbDriver.php';

include '../src/TelegramCommunication.php';
include '../src/TelegramOwn.php';
include '../src/SendMessage.php';
include '../src/SqlDatabaseConnection.php';

$header = 'telegram';

if($header == 'telegram') {
    $a = new SendMessage();
    $a->send('sendMessage', ['chat_id' => -1001658519019, 'text' => 'Hi, jek']);
    $tg = new TelegramCommunication(new TelegramOwn(), new SendMessage(), new SqlDatabaseConnection());
    $tg->communicate();
}
