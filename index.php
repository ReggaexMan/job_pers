<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Ajouter un emploi</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>

    <div class="container">
        <h1>Ajouter un nouvel emploi</h1>

        <form action="job/ajout_job.php" method="post">
            <div class="form-group">
                <label for="jobName">Libellé du job</label>
                <input type="text" class="form-control" id="jobName" name="job_nom" required>
            </div>

            <div class="form-group">
                <label for="jobDesc">Description du job</label>
                <textarea class="form-control" id="jobDesc" name="job_desc" rows="6" placeholder="Entrez une description détaillée du job" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter le job</button>
        </form>
        <div class="btn-group">
            <a href="personne/liste_personne.php" class="btn btn-outline-primary">Liste du personnel</a>
            <a href="job/liste_job.php" class="btn btn-outline-primary">Liste des emplois</a>
        </div>
    </div>

</body>

</html>