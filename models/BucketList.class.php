<?php

class BucketList {
    private mysqli $db;
    private $name;
    private $description;
    private $priority;
    private $completed;

    // Konstruktor som tar emot mysqli-anslutningen
    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    // Metod för att hämta bucketlistan från databasen
    public function getBucketList(): array {
        $sql = "SELECT * FROM bucketlist;";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}