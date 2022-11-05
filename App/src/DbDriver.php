<?php

interface DbDriver {
    function connect();
    function insertData($data);
    function reviewData($data);
    function updateData($data, $conditions);
}