<?php



include '../src/DataFormatter.php';

$a = new DataFormatter();

//    function getallheaders()
//    {
//        $headers = [];
//        foreach ($_SERVER as $name => $value) {
//            if (substr($name, 0, 5) == 'HTTP_') {
//                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
//            }
//        }
//        return $headers;
//    }
function a() {
    $data=json_decode(file_get_contents("php://input"),true, 20, JSON_OBJECT_AS_ARRAY);
//    $class = new PostHook();
//    $data = $class->getData();

    if($data!=null) {
        file_put_contents('data.json', json_encode($data));
//        file_put_contents('data1.json', json_encode($class->headers['X-Telegram-Bot-Api-Secret-Token']));
        refresh( 5);
    }
    else {
        refresh( 5);
    }
}
function refresh($time){
    $current_url = $_SERVER[ 'REQUEST_URI' ];
    header( "Refresh: " . $time . "; URL=$current_url" );
    $ret = json_decode(file_get_contents('data.json'), true);
//    $ret1 = json_decode(file_get_contents('data1.json'), true);
//    echo $ret['message']['from']['first_name'];
//    echo $ret['message']['chat']['id'];
    echo "<pre>";
    print_r($ret);
    echo "</pre>";
//    echo "<pre>";
//    print_r($ret1);
//    echo "</pre>";
}
a();
?>
