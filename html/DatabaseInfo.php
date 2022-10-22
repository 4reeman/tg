<?php

include 'DatabaseConnection.php';

class DatabaseInfo {

    public $dbConnection;

    public function __construct() {
        $this->dbConnection = DatabaseConnection::getInstance();
    }

    public function insertData($user_id, $user_name, $chat_id) {
        if (!$this->reviewData($user_id, $chat_id)) {
            try {
                $query = "INSERT INTO user_data (user_id, user_name, chat_id) VALUES (?,?,?)";
                $prepared = $this->dbConnection->connection->prepare($query);
                $prepared->execute([$user_id, $user_name, $chat_id]);
            } catch (Exception $e) {
                file_put_contents('my_log.txt', "Database error insertData: " . $e->getMessage());
            }
        }
    }

    public function reviewData($user_id, $chat_id) {
        try {
            $query = 'SELECT user_id, chat_id FROM user_data WHERE user_id=? AND chat_id=?';
            $prepared = $this->dbConnection->connection->prepare($query);
            $prepared->execute([$user_id, $chat_id]);
            return $prepared->rowCount();
        } catch (Exception $e) {
            file_put_contents('my_log.txt', "Database error reviewData: " . $e->getMessage());
        }
    }
}
