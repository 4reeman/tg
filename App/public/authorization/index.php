<?php
define('BOT_TOKEN', '5793129764:AAGR9DRRbMjBl4Byei70Sec6OiqAfuwdQRw'); // place bot token of your bot here
//var_dump($_GET);echo('</br>');
//var_dump($_SERVER);
//echo('</br>');
//print_r($_SERVER['REDIRECT_QUERY_STRING']);echo('</br>');
//if ($_SERVER["QUERY_STRING"] == null){
//    echo 'url empty';
//}
//phpinfo();
function checkTelegramAuthorization($auth_data)
{
    $check_hash = $auth_data['hash'];
    unset($auth_data['hash']);
    $data_check_arr = [];
    foreach ($auth_data as $key => $value)
    {
        $data_check_arr[] = $key . '=' . $value;
    }
    sort($data_check_arr);
    $data_check_string = implode("\n", $data_check_arr);
    $secret_key = hash('sha256', BOT_TOKEN, true);
    $hash = hash_hmac('sha256', $data_check_string, $secret_key);
    if (strcmp($hash, $check_hash) !== 0) {
        throw new Exception('Data is NOT from Telegram') ;
    }
    if ((time() - $auth_data['auth_date']) > 86400) {
        throw new Exception('Data is outdated');
    }

    return $auth_data;
}

function saveTelegramUserData($auth_data)
{
    $auth_data_json = json_encode($auth_data);
    setcookie('tg_user', $auth_data_json);
}

try
{
    $auth_data = checkTelegramAuthorization($_GET);
    print_r($auth_data);
//    saveTelegramUserData($auth_data);
}
catch(Exception $e)
{
    die($e->getMessage());
}

//header('Location: /trello/index.php');
?>

