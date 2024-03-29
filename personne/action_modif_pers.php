<?php
include '../config_db.php';

$id = $_POST["id"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$job = $_POST["job"];

try {
    $db = new PDO("mysql:host=$host;dbname=$base_donnees_nom;charset=utf8", $username, $password);
    $dataModifPers = [
        "nom" => $nom,
        "prenom" => $prenom,
        "job" => $job,
        "id" => $id
    ];
    $sqlModifPers = "UPDATE personne
    SET nom=:nom, prenom=:prenom, job=:job
    WHERE id =:id";
    $stmt = $db->prepare($sqlModifPers);
    $information_requete = $stmt->execute($dataModifPers);
    if ($information_requete) {
        echo "<p>Modification effectuee</p>";
    } else {
        echo "<p>Modification non effectuee</p>";
    }
    echo "<a href=liste_personne.php> LISTE DES Personnes</a>";
    echo "<a href=index.php> HOME </a>";
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} finally {
    $db = null;
}
