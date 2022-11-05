<?php

include '../src/InputDataInterface.php';
include '../src/SendMessageInterface.php';
include '../src/DbDriver.php';

include '../src/TelegramCommunication.php';
include '../src/TelegramOwn.php';
include '../src/SendMessage.php';
include '../src/SqlDatabaseConnection.php';

//
$headers = getallheaders();
//function a() {
//    $data=json_decode(file_get_contents("php://input"));
////    $data = json_encode($_SERVER);
//    if($data!=null) {
//        file_put_contents('data.json', json_encode($data));
//        file_put_contents('data1.json', json_encode(getallheaders()));
//        refresh( 3 );
//    }
//    else {
//        echo (is_object($data));
//        refresh( 3);
//    }
//}
//function refresh($time){
//    $current_url = $_SERVER[ 'REQUEST_URI' ];
//    header( "Refresh: " . $time . "; URL=$current_url" );
//    $ret = json_decode(file_get_contents('data.json'), true);
//    $ret1 = json_decode(file_get_contents('data1.json'), true);
//    echo ' </br>';
//    echo 'input';
//    var_dump($ret);
//    echo ' </br>';
//    echo 'header';
//    var_dump($ret1);
//}
//a();
//$headers = [
//    "Source" => 'trello_authorization'
//];
$tg_header = 'telegram';

if($tg_header == 'telegram') {
    $tg = new TelegramCommunication(new TelegramOwn(), new SendMessage(), new SqlDatabaseConnection());
    $tg->communicate();
}

if($headers["Source"] == 'trello_authorization') {
    $authorization = new TrelloAuthorizationCommunication(new TrelloAuthorizationService(), new SendMessage(), new SqlDatabaseConnection());
    $authorization->insertKey();
}


