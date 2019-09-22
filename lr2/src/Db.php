<?php

class Db
{
    static private $instance = null;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            try {
                $host = "127.0.0.1";
                $port = "3360";
                $dbname = "tzi_lr1";
                $dbuser = "root";
                $dbpassword = "";
                $dsn = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $dbname;
                self::$instance = new PDO($dsn, $dbuser, $dbpassword);
            } catch (PDOException $e) {
                echo $e->getMessage();
                echo json_encode([
                    'status' => false,
                    'line' => __LINE__,
                    'body' => [
                        'error_key' => 'PDOException'
                    ]
                ]);
                $instance = null;
            }

        }
        return self::$instance;
    }
}