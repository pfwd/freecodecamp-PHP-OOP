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
     * @var string
     */
    private $env = 'test';

    /**
     * Connection constructor.
     * @param string $env
     */
    public function __construct(string $env = 'test')
    {
        $this->env = $env;
    }

    public function getCreds():array
    {
        return  [
            'username' => getenv( strtoupper($this->env) . '_MYSQL_USERNAME'),
            'password' => getenv(strtoupper($this->env) . '_MYSQL_ROOT_PASSWORD'),
            'host' => getenv(strtoupper($this->env) . '_MYSQL_HOST'),
            'database' => getenv(strtoupper($this->env) . '_MYSQL_DATABASE')
        ];
    }

    /**
     * @return PDO
     */
    public function open():PDO
    {
        $creds = $this->getCreds();

        if(!self::$conn instanceof PDO) {
            $username = $creds['username'];
            $password = $creds['password'];
            $host = $creds['host'];
            $database = $creds['database'];

            $dsn = 'mysql:host=' . $host . ';dbname=' . $database;

            self::$conn = new PDO($dsn, $username, $password);
        }
        return self::$conn;
    }
}