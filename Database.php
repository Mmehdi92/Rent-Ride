<?php
class Database
{
    public $conn;

    /**
     * Constructor for the Database class
     * @param  array $config
     * 
     */
    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
            echo "Database connection successful";
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }


    /**
     * Get all records from a table
     * @param string $query
     * @return PDOStatement
     * @throws PDOException
     */

    public function query($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
        throw new Exception("Query failed: " . $e->getMessage());
        }
    }
}
