<?php
namespace Framework;
use PDOException;
use Exception;
use PDO;
require_once basePath('config/db.php'); 
class Database
{
    private $conn;
    private static $instance = null;

    /**
     * Private constructor for the Database class
     */
    private function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ    
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
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
            $config = require basePath('config/db.php');
            self::$instance = new Database($config);
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
}
