<?php

include '../src/InputDataInterface.php';
include '../src/SendMessageInterface.php';
include '../src/DbDriver.php';

include '../src/TelegramCommunication.php';
include '../src/TelegramOwn.php';
include '../src/SendMessage.php';
include '../src/SqlDatabaseConnection.php';

function a() {
    $data=json_decode(file_get_contents("php://input"),true, 20, JSON_OBJECT_AS_ARRAY);
    if($data!=null) {
        file_put_contents('data.json', json_encode($data));
        refresh( 100 );
    }
    else {
        echo (is_object($data));
        refresh( 100);
    }
}
function refresh($time){
    $current_url = $_SERVER[ 'REQUEST_URI' ];
    header( "Refresh: " . $time . "; URL=$current_url" );
    $ret = json_decode(file_get_contents('data.json'), true);
    echo $ret['message']['from']['first_name'];
    echo $ret['message']['from']['id'];
    echo "<pre>";
    print_r($ret);
    echo "</pre>";
}
a();

$header = 'telegram';

if($header == 'telegram') {
    $tg = new TelegramCommunication(new TelegramOwn(), new SendMessage(), new SqlDatabaseConnection());
    $tg->communicate();
}
//else {
//
//}
