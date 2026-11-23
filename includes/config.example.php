<?php
// Konfigurationsfil för webbplatsen
$sitename = "Innan jag dör..";
$divider = " | ";

$devMode = true; // Sätt till false i produktion

// Aktivera felrapportering
error_reporting(E_ALL);
ini_set("display_errors", $devMode ? "1" : "0");

// Autoload-funktion för att ladda klasser automatiskt 
spl_autoload_register(function ($class_name) {
    include __DIR__ . '/../models/' . $class_name . '.class.php';
});

if ($devMode) {
    // Utvecklingsinställningar
    define("DBHOST", "localhost");
    define("DBUSER", "ditt_anvandarnamn");
    define("DBPASS", "ditt_losenord");
    define("DBDATABASE", "ditt_databasnamn");
} else {
    // Produktionsinställningar
    define("DBHOST", "localhost");
    define("DBUSER", "ditt_anvandarnamn");
    define("DBPASS", "ditt_losenord");
    define("DBDATABASE", "ditt_databasnamn");
}
