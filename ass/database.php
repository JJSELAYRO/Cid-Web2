<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'sims_db';
    private $username = 'root';
    private $password = '';
    private $conn;
    public function getConnection() {
        $this->conn = null;

        try {
            // First connect without database to create it if it doesn't exist
            $this->conn = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Create database if it doesn't exist
            $this->conn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            
            // Now connect to the specific database
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $exception) {
            error_log("Database connection error: " . $exception->getMessage());
            return null;
        }

        return $this->conn;
    }

    public function createTable() {
        if (!$this->conn) {
            error_log("No database connection available for table creation.");
            return;
        }
        
        $sql = "CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            student_id VARCHAR(20) UNIQUE NOT NULL,
            full_name VARCHAR(100) NOT NULL,
            course VARCHAR(50) NOT NULL,
            year_level INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (student_id),
            INDEX (course),
            INDEX (year_level)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        try {
            $this->conn->exec($sql);
        } catch(PDOException $exception) {
            error_log("Table creation error: " . $exception->getMessage());
        }
    }
}
?>