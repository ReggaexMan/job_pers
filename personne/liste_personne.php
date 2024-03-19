<?php
$base_donnees_nom = "wxqudwagfko2cwys";
try {
    $db = new PDO("mysql:host=lmag6s0zwmcswp5w.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=$base_donnees_nom;charset=utf8", "swv9e6stzf4ehkcl", "fvtyqc310t5s4cgf");
    $tousPers = "SELECT * FROM personne";
    $stmt = $db->prepare($tousPers);
    $stmt->execute();
    $personnes = $stmt->fetchAll();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Liste des personnes</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h1>Liste des personnes</h1>
        <div class="list-container">
            <?php if (!empty($personnes)) : ?>
                <?php foreach ($personnes as $pers) : ?>
                    <div class="person-item">
                        <span class="person-name"><?php echo htmlspecialchars($pers['nom']) . " " . htmlspecialchars($pers['prenom']); ?></span>
                        <div class="person-actions">
                            <a href="vue_modif_pers.php?id=<?php echo $pers['id']; ?>" class="btn btn-outline-primary">Modifier</a>
                            <a href="supp_pers.php?id=<?php echo $pers['id']; ?>" class="btn btn-outline-danger">Supprimer</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune personne trouvée.</p>
            <?php endif; ?>
            <a href="index.php" class="btn btn-link">Retour à l'accueil</a>
        </div>
    </div>
    <!-- Fermeture de la connexion à la base de données -->
    <?php $db = null; ?>
</body>

</html>