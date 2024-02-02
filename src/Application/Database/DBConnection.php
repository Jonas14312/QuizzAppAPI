<?php

namespace App\Application\Database;

use PDO;
use PDOException;

class DBConnection
{


    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("sqlsrv:server = tcp:jonasmluishtobiass.database.windows.net,1433; Database = DatabaseQuizzApp", "Jonas", "76cLAnzYLX4");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print("Error connecting to SQL Server.");
            die(print_r($e));
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
