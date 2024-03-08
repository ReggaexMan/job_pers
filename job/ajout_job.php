<?php
$label = $_POST['job_nom'] ?? '';
$desc = $_POST['job_desc'] ?? '';
$base_donnees_nom = "job_pers";
$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db = new PDO("mysql:host=localhost;dbname=$base_donnees_nom;charset=utf8", "root", "root");
        $sqlInsertJob = "INSERT INTO job (label, description_job) VALUES (:label, :desc)";
        $stmt = $db->prepare($sqlInsertJob);
        $stmt->bindParam(':label', $label);
        $stmt->bindParam(':desc', $desc);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $message = "Enregistrement effectué";
            $success = true;
        } else {
            $message = "Erreur d'enregistrement";
        }
    } catch (PDOException $e) {
        $message = 'Erreur : ' . $e->getMessage();
    } finally {
        $db = null;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Ajout d'un emploi</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h1>Ajout d'un emploi</h1>
        <div class="feedback <?php echo $success ? 'success' : 'error'; ?>">
            <p><?php echo $message; ?></p>
            <a href='liste_job.php' class="btn btn-primary">Retour à la liste des jobs</a>
        </div>
    </div>
</body>

</html>