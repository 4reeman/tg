<?php

interface DbDriver {
    function connect();
    function insertData($data);
    function reviewData($data, $quantity);
    function updateData($data, $conditions);
}