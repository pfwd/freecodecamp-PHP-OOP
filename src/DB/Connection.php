<?php
namespace App\DB;
use PDO;

class Connection
{
    /**
     * @var PDO
     */
    private static $conn;

    /**
     * @return PDO
     */
    public function open():PDO
    {
        if(false === self::$conn instanceof PDO) {
            $username = getenv('MYSQL_USERNAME');
            $password = getenv('MYSQL_ROOT_PASSWORD');
            $host = getenv('MYSQL_HOST');
            $database = getenv('MYSQL_DATABASE');

            $dsn = 'mysql:host=' . $host . ';dbname=' . $database;

            self::$conn = new PDO($dsn, $username, $password);
        }
        return self::$conn;
    }
}