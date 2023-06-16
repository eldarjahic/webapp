<?php
require_once __DIR__ . "/../Config.class.php";

class DBConnection
{
    private static $instance;

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $servername = Config::DB_HOST();
            $username = Config::DB_USERNAME();
            $password = Config::DB_PASSWORD();
            $schema = Config::DB_SCHEMA();
            self::$instance = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}