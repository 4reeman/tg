<?php

Class DatabaseConnection {

    final const HOST = 'localhost;';
    final const DBNAME = 'server4reema';
    final const USERNAME = 'server4reema';
    final const PASSWORD = 'DbXDPn9ExgMg';
    final const DEV = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    final const DSN = 'mysql:host=' . self::HOST . 'dbname=' . self::DBNAME;

    public static $instance = null;

    public $connection;

    private function __construct() {
        try {
             $this->connection = new PDO(self::DSN, self::USERNAME, self::PASSWORD, self::DEV);
        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    protected function __clone() {}

    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

}