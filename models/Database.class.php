<?php

class Database {
    private mysqli $connection;

    public function __construct() {
        $this->connection = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        // Felkontroll för anslutningen 
        if ($this->connection->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->connection->connect_error);
        }
    }

    // Metod för att hämta anslutningen
    public function getConnection() : mysqli {
        return $this->connection;
    }
}