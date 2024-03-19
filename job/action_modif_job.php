<?php
include '../config_db.php';

$label = $_POST['job_nom'] ?? '';
$desc = $_POST['job_desc'] ?? '';
$id = $_POST['id'] ?? '';
$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($id)) {
    try {
        $db = new PDO("mysql:host=$host;dbname=$base_donnees_nom;charset=utf8", $username, $password);
        $sqlUpdateJob = "UPDATE job SET label = :label, description_job = :desc WHERE id = :id";
        $stmt = $db->prepare($sqlUpdateJob);
        $stmt->bindParam(':label', $label);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $message = "Modification effectuée";
            $success = true;
        } else {
            $message = "Aucune modification apportée ou erreur de modification";
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
    <title>Modification d'un emploi</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h1>Résultat de la modification</h1>
        <div class="feedback <?php echo $success ? 'success' : 'error'; ?>">
            <p><?php echo $message; ?></p>
            <a href='liste_job.php' class="btn btn-primary">Retour à la liste des jobs</a>
        </div>
    </div>
</body>

</html>