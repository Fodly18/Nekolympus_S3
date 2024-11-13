<?php

namespace Nekolympus\Project\databases;

use PDO;
use PDOException;

class Database
{
    private $conn;                     

    public function __construct()
    {
        $servername = $_ENV["DB_HOST"]; 
        $username =   $_ENV["DB_USERNAME"];      
        $password =   $_ENV["DB_PASSWORD"];      
        $dbName =   $_ENV["DB_NAME"];     

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}