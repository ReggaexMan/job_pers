<?php
include '../config_db.php';

try {
    $db = new PDO("mysql:host=$host;dbname=$base_donnees_nom;charset=utf8", $username, $password);
    $sqlAllJobs = 'SELECT * FROM job';
    $stmt = $db->prepare($sqlAllJobs);
    $stmt->execute();
    $jobs = $stmt->fetchAll(\PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Liste des emplois</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h1>Liste des emplois</h1>
        <div class="list-container">
            <ul class="list-group">
                <?php foreach ($jobs as $job) : ?>
                    <li class="list-group-item">
                        <span class="job-label"><?php echo htmlspecialchars($job['label']); ?></span>
                        <div class="list-item-actions">
                            <a href="vue_modif_job.php?id=<?php echo $job['id']; ?>" class="btn btn-outline-primary">Modifier</a>
                            <a href="supp_job.php?id=<?php echo $job['id']; ?>" class="btn btn-outline-danger">Supprimer</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="../index.php" class="btn btn-link">Ajouter un nouvel emploi</a>
        </div>
        <!-- Fermeture de la connexion à la base de données -->
        <?php $db = null; ?>
    </div>
</body>

</html>