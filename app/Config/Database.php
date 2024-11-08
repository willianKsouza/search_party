<?php
namespace App\config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                $host = $_ENV['DB_HOST'];
                $port = $_ENV['DB_PORT'];
                $dbname = $_ENV['DB_DATABASE'];
                $username = $_ENV['DB_USERNAME'];
                $password = $_ENV['DB_PASSWORD'];

                $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                self::$instance = new PDO($dsn, $username, $password, $options);

            } catch (PDOException $e) {
                die("Erro de conexão com o banco de dados: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}