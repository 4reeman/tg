<?php
//include "../config/db_config.php";
Class SqlDatabaseConnection implements DbDriver {

    private $connection;

    final const HOST = 'localhost;';
    final const DBNAME = 'server4reema';
    final const USERNAME = 'server4reema';
    final const PASSWORD = 'DbXDPn9ExgMg';
//    final const DEV = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    final const DSN = 'mysql:host=' . self::HOST . 'dbname=' . self::DBNAME;

    public function __construct() {
       $this->connect();
    }

    public function connect() {
        try {
            $pdo = new PDO(self::DSN, self::USERNAME, self::PASSWORD);
            $this->connection = $pdo;
        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }
    /*
     * example
     * $data = [
	 *  'chat_id' => '12431435345',
	 *  'user_name' => 'jek-12',
	 *  'api_key' => 'asdfasdfas23423rasdf'
	 * ];
     */
    public function insertData($data) {
        $columns = "";
        $holders = "";
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $holders .= ($holders == "") ? "" : ", ";
            $holders .= ":$column";
        }
        try {
            $query = "INSERT INTO `user_data` ($columns) VALUES ($holders)";
            $prepared = $this->connection->prepare($query);
            foreach ($data as $placeholder => $value) {
                $prepared->bindValue(":$placeholder", $value);
            }
            $prepared->execute();
        } catch (Exception $e) {
            file_put_contents('my_log.txt', "Database error insertData: " . $e->getMessage());
        }
    }

// rework
    function reviewData($data) {
        $columns = "";
        $holders = "";
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $holders .= ($holders == "") ? "" : " AND ";
            $holders .= "$column=?";
        }
        try {
            $query = "SELECT $columns FROM `user_data` WHERE $holders";
            $prepared = $this->connection->prepare($query);
            $arr=[];
            foreach ($data as $placeholder => $value) {
                array_push($arr, $value);
            }
            $prepared->execute($arr);
            return $prepared->rowCount();
        } catch (Exception $e) {
            file_put_contents('my_log.txt', "Database error reviewData: " . $e->getMessage());
        }
    }

//    function updateData()
//    {
//        // TODO: Implement updateData() method.
//    }
}