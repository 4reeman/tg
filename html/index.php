<?php

include 'DataFormatter.php';
//include 'DatabaseInfo.php';
//include 'DatabaseConnection.php';

$a = new DataFormatter();
//echo($a->data);
//$cl = new DatabaseInfo();
//
//function a() {
//    $data=json_decode(file_get_contents("php://input"),true, 20, JSON_OBJECT_AS_ARRAY);
//    if($data!=null) {
//        file_put_contents('data.json', json_encode($data));
//        refresh( 1 );
//    }
//    else {
//        echo (is_object($data));
//        refresh( 1);
//    }
//}
//function refresh($time){
//    $current_url = $_SERVER[ 'REQUEST_URI' ];
//    header( "Refresh: " . $time . "; URL=$current_url" );
//    $ret = json_decode(file_get_contents('data.json'), true);
//    echo "<pre>";
//    print_r($ret);
//    echo "</pre>";
//}
//a();
//
//$response = "Ciao $firstname, benvenuto!";
//
//$keyboard = [
//    'inline_keyboard' => [
//        [
//            ['text' => 'forward me to groups']
//        ]
//    ]
//];
//
//$encodedKeyboard = json_encode($keyboard);
//$parameters =
//    array(
//        'chat_id' => '-1001658519019',
//        'text' => 'custom text',
//        'reply_markup' => $encodedKeyboard
//    );
//$parameters["method"] = "sendMessage";
//echo json_encode($parameters);



/*$data = json_decode(file_get_contents("php://input"),true, 20, JSON_OBJECT_AS_ARRAY);

$apiToken = "5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw";

function answer($id, $name, $token) {
    $data = [
        'chat_id' => $id,
        'text' => 'Hi, ' . $name,
    ];
    $response = file_get_contents("https://api.telegram.org/bot$token/sendMessage?" .
        http_build_query($data) );
}

function insert($connection, $data, $token) {
    if (!is_null($im = $data['message']['from']['id']) && !is_null($name = $data['message']['from']['first_name'])) {
        try {
            $qr = 'SELECT unique_id FROM users
                    WHERE unique_id = :bla';

            if($asd = $connection->prepare($qr)) {
                $check = $asd->bindParam('bla', $im);
                file_put_contents('my_log.txt', "asdddddd first:" . $check);
            }

//        $stmt = $connection->execute(['an' => $im]);
//        $bla = $user = $stmt->fetch();
            file_put_contents('my_log.txt', "asdddddd second:" . $check . '  / '. $im .$name);
//        answer($im, $im.' '.count($res), $token);
//        $a = '783176196';
//        $b = 'SELECT unique_id FROM users WHERE unique_id=$im';
        }
        catch(PDOException $e) {
            $sql = "INSERT INTO users (unique_id, user_name) VALUES (?,?)";
            $connection->prepare($sql)
                ->execute([$im, $name]);
            answer($im, $name, $token);
            file_put_contents('my_log.txt', "Database error insert2: " . $e->getMessage());
        }
    }
    else {
        file_put_contents('my_log.txt', "null");
    }


//            ->execute([$im])
//        ->fetch();
//       answer($im, count($b), $token);

}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=server4reema', $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    insert($pdo, $data, $apiToken);
}
catch (PDOException $e) {
    file_put_contents('my_log.txt', "Database error: " . $e->getMessage());
}

*/

//function a() {
//    $data=json_decode(file_get_contents("php://input"),true, 20, JSON_OBJECT_AS_ARRAY);
//    if($data!=null) {
//        file_put_contents('data.json', json_encode($data));
//        refresh( 100 );
//    }
//    else {
//        echo (is_object($data));
//        refresh( 100);
//    }
//}
//function refresh( $time){
//    $current_url = $_SERVER[ 'REQUEST_URI' ];
//    header( "Refresh: " . $time . "; URL=$current_url" );
//    $ret = json_decode(file_get_contents('data.json'), true);
//    echo $ret['message']['from']['first_name'];
//    echo $ret['message']['from']['id'];
//    echo "<pre>";
//    print_r($ret);
//    echo "</pre>";
//}
//a();

//$trello_auth = 'https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=ea3b9632108faebab5ffab2128e103ef';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trello Authorization</title>
    <link rel="stylesheet" href="dist/css/style.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class='main'>
    <form id="validation" class="form_validation">
        <label for="api_key">Please, enter Your Key:</label>
        <input type="text" id="api_key">
        <input type="button" id="submit_btn" class="submit" value="Submit">
    </form>
</div>
<script src="dist/js/index.min.js"></script>
</body>
</html>
