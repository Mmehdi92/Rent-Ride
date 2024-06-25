<?php

namespace Framework;

use PDOException;
use Exception;
use PDO;

class Database
{
    private $conn;
    private static $instance = null;
    private static $config = null;


    private function __construct()
    {
        $dsn = "mysql:host=" . self::$config['host'] . ";port=" . self::$config['port'] . ";dbname=" . self::$config['dbname'];
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, self::$config['username'], self::$config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Get the instance of the Database
     * @return Database
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$config = require_once basePath('Framework/config/db.php');
            self::$instance = new Database();
        }

        return self::$instance;
    }

    /**
     * Execute a query
     * @param string $query
     * @param array $params
     * @return PDOStatement
     * @throws Exception
     */
    public function query($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);

            foreach ($params as $param => $value) {
                $stmt->bindValue(':' . $param, $value);
            }

            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }

    /**
     * Get the last inserted id
     * @return int
     */
    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
