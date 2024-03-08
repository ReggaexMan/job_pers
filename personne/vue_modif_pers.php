<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js"></script>
</head>

<body>

    <?php
    $base_donnees_nom = "job_pers";
    $id = $_GET["id"];
    try {
        $db = new PDO("mysql:host=localhost;dbname=$base_donnees_nom;charset=utf8", "root", "root");
        $data = [
            "id" => $id
        ];
        $sql = "SELECT * FROM personne where id=:id";
        $stmt = $db->prepare($sql);
        $infoReq = $stmt->execute($data);
        $pers = $stmt->fetch();

        $sql = "SELECT * FROM job";
        $stmt = $db->prepare($sql);
        $infoReq = $stmt->execute();
        $jobs = $stmt->fetchAll();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    } finally {
        $db = null;
    }

    ?>

    <div class="container">
        <h1>Modifier une personne</h1>

        <form action="action_modif_pers.php" method="post" class="mb-3">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom de la personne</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($pers["nom"]); ?>" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom de la personne</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($pers["prenom"]); ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="mb-3">
                <label for="job" class="form-label">Job du personnel</label>
                <select class="form-select" id="job" name="job">
                    <option value="">-- Veuillez choisir une option --</option>
                    <?php foreach ($jobs as $job) {
                        $selected = ($job["id"] == $pers["job"]) ? "selected" : "";
                        echo "<option value=" . htmlspecialchars($job["id"]) . " $selected>" . htmlspecialchars($job["label"]) . "</option>";
                    } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier le Personnel</button>
        </form>
        <a href="index.php" class="btn btn-outline-primary">Accueil</a>
    </div>

</body>

</html>