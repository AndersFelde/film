<?php
// Tilkoblingsinformasjon
$tjener = "localhost:3308";
$brukernavn = "root";
$passord = "Mysql123";
$database = "film";

// Opprette en kobling
$kobling = new mysqli($tjener, $brukernavn, $passord, $database);

// Sjekk om koblingen virker
if ($kobling->connect_error) {
    die("Noe gikk galt: " . $kobling->connect_error);
}

// Angi UTF-8 som tegnsett
$kobling->set_charset("utf8");
?>
