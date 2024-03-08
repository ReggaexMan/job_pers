<?php
$base_donnees_nom = "job_pers";
try {
    $db = new PDO("mysql:host=localhost;dbname=mysql;charset=utf8", "root", "root");
    $sql_creation_bdd = "CREATE DATABASE IF NOT EXISTS $base_donnees_nom";
    $stmt = $db->prepare($sql_creation_bdd);
    $information_requete = $stmt->execute();
    if ($information_requete) {
        echo "<p>Base JOB_PERS créée</p>";
    } else {
        echo "<p>Base non créée</p>";
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} finally {
    $db = null;
}

try {
    $db = new PDO("mysql:host=localhost;dbname=$base_donnees_nom;charset=utf8", "root", "root");
    $sqlCreationTableJob = "CREATE TABLE IF NOT EXISTS job (
        id int NOT NULL AUTO_INCREMENT,
        label varchar(30) NOT NULL,
        description_job varchar(100),
        PRIMARY KEY (id)
    ); ";

    $sqlCreationTablePers = "CREATE TABLE IF NOT EXISTS personne (
        id int NOT NULL AUTO_INCREMENT,
        nom varchar(50) NOT NULL,
        prenom varchar(50),
        job int,
        PRIMARY KEY (id),
        FOREIGN KEY (job) REFERENCES job(id)
    )";
    // creation table job
    $stmt = $db->prepare($sqlCreationTableJob);
    $information_requete = $stmt->execute();

    if ($information_requete) {
        echo "<p>Table JOB créée</p>";
    } else {
        echo "<p>Base non créée</p>";
    }

    // creation table personne
    $stmt = $db->prepare($sqlCreationTablePers);
    $information_requete = $stmt->execute();

    if ($information_requete) {
        echo "<p>Base PERSONNE créée</p>";
    } else {
        echo "<p>Base non créée</p>";
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} finally {
    $db = null;
}
