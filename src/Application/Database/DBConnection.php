<?php

namespace App\Application\Database;

use PDO;
use PDOException;

class DBConnection {


    private $connection;

    public function __construct() {
        try {
            $conn = new PDO("sqlsrv:server = tcp:jonasmluishtobiass.database.windows.net,1433; Database = DatabaseQuizzApp", "Jonas", "76cLAnzYLX4");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            print("Error connecting to SQL Server.");
            die(print_r($e));
        }
    }

    public function getConnection() {
        return $this->connection;
    }

}





?>