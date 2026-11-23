<?php
/* Reset script for the Bucket List database */
require_once __DIR__ . '/../includes/config.php';

mysqli_report(MYSQLI_REPORT_OFF); // Stänger av felrapportering för mysqli

$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

if ($db->connect_error) {
    die("<p>Connection failed: </p>" . $db->connect_error);
} else {
    echo "<p>Connected successfully</p>";
}

// Ta bort tabellen
$db->query("DROP TABLE IF EXISTS bucketlist");

// Skapa tabellen
$sql = "CREATE TABLE bucketlist (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    description VARCHAR(255) NOT NULL,
    priority ENUM('low', 'medium', 'high') NOT NULL,
    completed BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// skicka SQL-frågan till servern
if ($db->query($sql) === TRUE) {
    echo "<p>Table 'bucketlist' created successfully</p>";
} else {
    echo "<p>Error creating table: </p>" . $db->error;
}
