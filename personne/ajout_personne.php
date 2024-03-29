<?php
include '../config_db.php';

$nom =  $_POST["nom"];
$prenom = $_POST["prenom"];
$job = $_POST["job"];

try {
    $db = new PDO("mysql:host=$host;dbname=$base_donnees_nom;charset=utf8", $username, $password);
    $dataInsertionPers = [
        "nom" => $nom,
        "prenom" => $prenom,
        "job" => $job
    ];
    $sqlInsertionPers = "INSERT INTO personne (nom, prenom, job) VALUES (:nom, :prenom, :job)";
    $stmt = $db->prepare($sqlInsertionPers);
    $information_requete = $stmt->execute($dataInsertionPers);
    if ($information_requete) {
        echo "<p>Enregistrement effectue</p>";
    } else {
        echo "<p>Enregistrement non effectue</p>";
    }
    echo "<a href=liste_personne.php> LISTE DES PERSONNES   </a>";
    echo "<a href=index.php> HOME   </a>";
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} finally {
    $db = null;
}
