<?php
include '../config_db.php';

$id = $_GET['id'];

try {
    // Initialisation de la connexion à la base de données
    $db = new PDO("mysql:host=$host;dbname=$base_donnees_nom;charset=utf8", $username, $password);

    // Vérification de l'existence de l'ID du job
    if ($id) {

        // Préparation de la requête SQL de suppression
        $sqlDeleteJob = 'DELETE FROM job WHERE id = :id';

        // Hachage du mot de passe avant de l'insérer dans la base de données
        $stmt = $db->prepare($sqlDeleteJob);

        // Liaison du paramètre "id"
        $stmt->bindParam(':id', $id);

        // Exécution de la requête préparée
        $stmt->execute();

        // Vérification de la réussite de la suppression
        if ($stmt->rowCount() == 1) {
            echo '<p>Suppression effectuée</p>';
        } else {
            echo '<p>Erreur lors de la suppression</p>';
        }

        echo '<a href="liste_job.php">Retour à la liste des jobs</a>';
    } else {
        echo '<p>Erreur : aucun ID de job fourni</p>';
    }
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
} finally {
    // Fermeture de la connexion à la base de données
    $db = null;
}
