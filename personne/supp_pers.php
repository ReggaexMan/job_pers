<?php
include '../config_db.php';

$id = $_GET["id"];

try {
    $db = new PDO("mysql:host=$host;dbname=$base_donnees_nom;charset=utf8", $username, $password);
    $dataSuppPers = [
        "id" => $id
    ];
    $sqlSuppPers = "DELETE FROM personne
    WHERE id =:id";
    $stmt = $db->prepare($sqlSuppPers);
    $information_requete = $stmt->execute($dataSuppPers);
    if ($information_requete) {
        echo "<p>Suppression effectuee</p>";
    } else {
        echo "<p>Suppression non effectuee</p>";
    }
    echo "<a href=liste_personne.php> LISTE DES personnes   </a>";
    echo "<a href=index.php> HOME   </a>";
} catch (Exception $e) {
    echo ('Erreur : ' . $e->getMessage());
} finally {
    $db = null;
}
