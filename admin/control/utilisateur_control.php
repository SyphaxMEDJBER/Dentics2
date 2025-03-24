<?php
require_once __DIR__ . '/../model/ConnexionDB.php';

use Admin\Model\ConnexionDB;

$db = ConnexionDB::getInstance();

// Ajout d'un dentiste
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'], $_POST['motdepasse'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['motdepasse'];

    $stmt = $db->prepare("INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES (?, ?, ?, 'dentist')");
    $stmt->execute([$nom, $email, $mdp]);

    header("Location: ../templates/back/utilisateurs.php");
    exit();
}

// Suppression d'un client
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $db->prepare("DELETE FROM utilisateur WHERE id = :id AND role = 'client'");
    $stmt->execute(['id' => $id]);

    header("Location: ../templates/back/utilisateurs.php");
    exit();
}
