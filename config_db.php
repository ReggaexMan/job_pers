<?php
$base_donnees_nom = "wxqudwagfko2cwys";
$host = "lmag6s0zwmcswp5w.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "swv9e6stzf4ehkcl";
$password = "fvtyqc310t5s4cgf";

try {
    $db = new PDO("mysql:host=$host;dbname=$base_donnees_nom;charset=utf8", $username, $password);
    // Mettre ici d'autres configurations si nécessaire
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
