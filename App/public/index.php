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
//        file_put_contents('data.json', json_encode($data));
        file_put_contents('data.json', json_encode($_SERVER));
        file_put_contents('data1.json', json_encode(getallheaders()));
        refresh( 3 );
    }
    else {
        echo (is_object($data));
        refresh( 3);
    }
}
function refresh($time){
    $current_url = $_SERVER[ 'REQUEST_URI' ];
    header( "Refresh: " . $time . "; URL=$current_url" );
    $ret = json_decode(file_get_contents('data.json'), true);
    $ret1 = json_decode(file_get_contents('data1.json'), true);
    var_dump($ret);
    var_dump($ret1);
}
a();

$tg_header = 'telegram';

if($tg_header == 'telegram') {
    $tg = new TelegramCommunication(new TelegramOwn(), new SendMessage(), new SqlDatabaseConnection());
    $tg->communicate();
}


