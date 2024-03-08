<?php
$base_donnees_nom = "job_pers";
try {
    $db = new PDO("mysql:host=localhost;dbname=$base_donnees_nom;charset=utf8", "root", "root");

    $tousJobs = "SELECT * FROM job";
    $stmt = $db->prepare($tousJobs);
    $stmt->execute();
    $jobs = $stmt->fetchAll();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} finally {
    $db = null;
}
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Ajouter un nouvel employé</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container">
        <h1>Ajouter un nouvel employé</h1>

        <form action="ajout_personne.php" method="post">
            <div class="form-group">
                <label for="personName">Nom</label>
                <input type="text" class="form-control" id="personName" name="nom" required>
            </div>

            <div class="form-group">
                <label for="personFirstName">Prénom</label>
                <input type="text" class="form-control" id="personFirstName" name="prenom" required>
            </div>

            <div class="form-group">
                <label for="personJob">Emploi :</label>

                <select class="form-control" id="personJob" name="job" required>
                    <option value="">-- Veuillez choisir une option --</option>
                    <?php
                    foreach ($jobs as $job) {
                        $label = htmlspecialchars($job["label"]);
                        $id = htmlspecialchars($job["id"]);
                        echo "<option value='$id'>$label</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter la personne</button>
        </form>
        <div class="btn-group">
            <a href="../personne/liste_personne.php" class="btn btn-outline-primary">Liste du personnel</a>
            <a href="../job/liste_job.php" class="btn btn-outline-primary">Liste des emplois</a>
        </div>
    </div>

</body>

</html>