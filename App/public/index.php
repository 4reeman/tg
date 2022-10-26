<?php

include '../src/DataFormatter.php';
$a = new DataFormatter();
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
