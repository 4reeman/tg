<?php

define('BOT_TOKEN', '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw');

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

    return $auth_data;
}

try {
    $auth_data = checkTelegramAuthorization($_GET);
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
    <link rel="stylesheet" href="dist/css/style.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class='main'>
    <div class="progress_wrapper">
        <div class="progress">
            <div class="step successful_step"></div>
            <p>Personal Key</p>
            <div class="progress_bar"></div>
        </div>
        <div class="progress">
            <div class="step"></div>
            <p>Secret Token</p>
            <div class="progress_bar"></div>
        </div>
    </div>
    <form id="validation_key" class="form_validation active_form">
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
        <label for="api_key">Personal Key:</label>
        <input type="text" id="api_key">
        <input type="button" id="submit_key" class="submit" value="Submit">
    </form>
    <form id="validation_token" class="form_validation">
        <div class="help_form">
            <button type="button" class="accordion">Where can i take a Secret Token</button>
            <div class="panels">
                <div class="panel">
                    <p>You can get your token by clicking on the button</p>
                    <input type="button" class="submit" value="Secret Token" onclick="window.open('https://trello.com/1/authorize?expiration=1day&name=MyPersonalToken&scope=read&response_type=token&key=' + document.getElementById('api_key').value, '__blank')">
                </div>
            </div>
        </div>
        <label for="api_key">Personal Token:</label>
        <input type="text" id="api_key">
        <input type="button" id="submit_token" class="submit" value="Submit">
    </form>
</div>
<script src="dist/js/index.min.js"></script>
</body>
</html>
