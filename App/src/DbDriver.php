<?php

interface DbDriver {
    function connect();
    function insertData($data);
    function selectData($data, $quantity);
    function updateData($data, $conditions);
//    function selectData($column, $condition, $value);
    function generalSelect($chat_id);
}