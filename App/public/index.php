<?php

include '../src/DataFormatter.php';
include "../src/PostHook.php";
$a = new DataFormatter();

//$b = new PostHook();
//$mon = $b->getData();

function a() {
    $data=json_decode(file_get_contents("php://input"),true, 20, JSON_OBJECT_AS_ARRAY);
    if($data!=null) {
        file_put_contents('data.json', json_encode($data));
//        refresh( 2 );
    }
    else {
//        refresh( 2);
    }
}
//function refresh($time){
//    $current_url = $_SERVER[ 'REQUEST_URI' ];
//    header( "Refresh: " . $time . "; URL=$current_url" );
//    $ret = json_decode(file_get_contents('data.json'), true);
////    echo $ret['message']['from']['first_name'];
////    echo $ret['message']['chat']['id'];
//    echo "<pre>";
//    print_r($ret);
//    echo "</pre>";
//}
//a();
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
        <div class="help_form">
            <button type="button" class="accordion">Where can i take a Personal Key</button>
            <div class="panels">
                <div class="panel">
                    <p>First of all, make sure You are logged into Trello:</p>
                    <input type="button" class="submit" value="Sign in Trello" onclick="window.open('https://trello.com/login', '__blank')">
                </div>
                <div class="panel">
                    <p>If you press the button below then the new browser tab where you can find Your Personal Key will open</p>
                    <p>You need to copy its value and then put it in form</p>
                    <input type="button" class="submit" value="Get Key" onclick="window.open('https://trello.com/app-key', '__blank')">
                </div>
            </div>
        </div>
        <label for="api_key">Your Personal Key:</label>
        <input type="text" id="api_key">
        <input type="button" id="submit_btn" class="submit" value="Submit">
    </form>
</div>
<script src="dist/js/index.min.js"></script>
</body>
</html>
