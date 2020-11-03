<?php

/**
 * Class Db
 * Used to deal with the database
 */
class Db {
    private static $instance;
    private $dbConnection;

    private function __Construct() {
        $creds = (require("db.credentials.php"))["mysql"];
        $this->dbConnection = new PDO("mysql:host={$creds['host']};dbname={$creds['dbname']}", $creds["username"], $creds["passwd"]);
        $this->dbConnection->exec('set names utf8');
    }

    /**
     * Gets the current instance of Db
     * @return Db The current instance
     */
    private static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    /**
     * Returns the current open PDO connection to the database
     * @return PDO The PDO connection
     */
    public static function getConnection() {
        try {
            return self::getInstance()->dbConnection;
        }
        catch (Exception $exception) {
            $message = "Could not connect to database.";

            return $message;
        }
    }
}