<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Modifier un emploi</title>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js"></script>
</head>

<body>
    <?php
    include '../config_db.php';
    $id = $_GET['id'] ?? null; // Récupère l'ID depuis l'URL

    if ($id) {
        try {
            // Initialisation de la connexion à la base de données
            $db = new PDO("mysql:host=$host;dbname=$base_donnees_nom;charset=utf8", $username, $password);

            // Préparation de la requête SQL de sélection
            $sqlGetJob = 'SELECT * FROM job WHERE id = :id';
            $stmt = $db->prepare($sqlGetJob);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Récupération du job spécifique
            $job = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        } finally {
            // Fermeture de la connexion à la base de données
            $db = null;
        }
    }
    ?>

    <div class="container">
        <h1>Modifier un emploi</h1>

        <?php if ($job) : ?>
            <form action="action_modif_job.php" method="post">
                <div class="form-group">
                    <label for="jobName">Libellé du job</label>
                    <input type="text" class="form-control" id="jobName" name="job_nom" value="<?php echo htmlspecialchars($job['label']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="jobDesc">Description du job</label>
                    <textarea class="form-control" id="jobDesc" name="job_desc" rows="6" required><?php echo htmlspecialchars($job['description_job']); ?></textarea>
                </div>

                <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>">

                <button type="submit" class="btn btn-primary">Modifier le job</button>
            </form>
        <?php else : ?>
            <p>Le job spécifié n'existe pas.</p>
        <?php endif; ?>
    </div>

</body>

</html>