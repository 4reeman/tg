<?php

include 'InputDataInterface.php';
include 'SendMessageInterface.php';
include 'DbDriver.php';

include 'TelegramCommunication.php';
include 'TelegramOwn.php';
include 'SendMessage.php';
include 'SqlDatabaseConnection.php';

$header = 'telegram';

if($header == 'telegram') {
    new TelegramCommunication(new TelegramOwn(), new SendMessage(), new SqlDatabaseConnection());
}