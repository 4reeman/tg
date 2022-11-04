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
    $bla = $_POST;
    $bla_js = json_encode($bla);
    if($data!=null) {
        file_put_contents('data.json', $bla_js);
//        file_put_contents('data1.json', json_encode(getallheaders()));
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
    $bla_js1 = file_get_contents('data.json');
//    $ret1 = json_decode(file_get_contents('data1.json'), true);
    var_dump($ret);
    var_dump($bla_js1);
}
a();

$tg_header = 'telegram';

if($tg_header == 'telegram') {
    $tg = new TelegramCommunication(new TelegramOwn(), new SendMessage(), new SqlDatabaseConnection());
    $tg->communicate();
}


