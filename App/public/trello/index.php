<?php

define('BOT_TOKEN', '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw'); // place bot token of your bot here

function checkTelegramAuthorization($auth_data) {
    $check_hash = $auth_data['hash'];
    unset($auth_data['hash']);
    $data_check_arr = [];
    foreach ($auth_data as $key => $value) {
        $data_check_arr[] = $key . '=' . $value;
    }
    sort($data_check_arr);
    $data_check_string = implode("\n", $data_check_arr);
    $secret_key = hash('sha256', BOT_TOKEN, true);
    $hash = hash_hmac('sha256', $data_check_string, $secret_key);
    if (strcmp($hash, $check_hash) !== 0) {
        throw new Exception('Data is NOT from Telegram');
    }
//    if ((time() - $auth_data['auth_date']) > 86400) {
//        throw new Exception('Data is outdated');
//    }

    return $auth_data;
}

function saveTelegramUserData($auth_data) {
    $auth_data_json = json_encode($auth_data);
//    setcookie('tg_user', $auth_data_json);
}

try {
    $auth_data = checkTelegramAuthorization($_GET);
//    saveTelegramUserData($auth_data);
} catch (Exception $e) {
    die($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trello Authorization</title>
    <link rel="stylesheet" href="trello/dist/css/style.min.css">
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
<script src="trello/dist/js/index.min.js"></script>
</body>
</html>
