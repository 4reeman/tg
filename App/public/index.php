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
    $tg = new TelegramCommunication(new TelegramOwn(), new SendMessage(), new SqlDatabaseConnection());
    $tg->communicate();
}
else {

}
