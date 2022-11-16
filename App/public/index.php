<?php

include '../src/DataSourceDefinerInterface.php';
include '../src/IncomingDataFormatter.php';
include '../src/TelegramSource.php';
include '../src/TelegramCommunicator.php';

$data=json_decode(file_get_contents("php://input"));
$headers = getallheaders();


//$get = http_get("https://api.trello.com/1/members/me/boards?fields=name,url&key=ea3b9632108faebab5ffab2128e103ef&token=6a7c621b92d4d7e0edad96fcfaeefdade788c459ae91a82b957e5c0e565b4fa4");

function a() {
    $data=json_decode(file_get_contents("php://input"));
    if($data!=null) {
        file_put_contents('data.json', json_encode($data));
        file_put_contents('data1.json', json_encode(getallheaders()));
        file_put_contents('data2.json', json_encode($_SERVER));
        refresh( 3 );
    }
    else {
        refresh( 3);
    }
}
function refresh($time){
    $current_url = $_SERVER[ 'REQUEST_URI' ];
    header( "Refresh: " . $time . "; URL=$current_url" );
    $ret = json_decode(file_get_contents('data.json'), true);
    $ret1 = json_decode(file_get_contents('data1.json'), true);
    $ret2 = json_decode(file_get_contents('data2.json'), true);
    echo ' </br>';
    echo "<pre>";
    print_r($ret);
    echo "</pre>";
    echo ' </br>';
    echo "<pre>";
    print_r($ret1);
    echo "</pre>";
    echo ' </br>';
    echo "<pre>";
    print_r($ret2);
    echo "</pre>";
}
a();

function result(IncomingDataFormatter $formatter) {
    $formatter->sendMessage();
}
result(new TelegramCommunicator(new SqlDatabaseConnection()));
//if($headers['X-Telegram-Bot-Api-Secret-Token'] == 'telegram') {
//}

//if($headers['Source'] == 'trello_authorization') {
//
//    switch ($headers['Data']) {
//        case 'key':
//            $authorization = new TrelloAuthorizationCommunication(new TrelloAuthorizationService(), new SendMessage(), new SqlDatabaseConnection());
//            $authorization->insertKey();
//            break;
//        case 'token':
//            $authorization = new TrelloAuthorizationCommunication(new TrelloAuthorizationService(), new SendMessage(), new SqlDatabaseConnection());
//            $authorization->insertToken();
//            break;
//        case 'message':
//            $tg = new TelegramCommunication(new TelegramOwn(), new SendMessage(), new SqlDatabaseConnection());
//            $tg->communicate();
//            break;
//    }

//}


?>

