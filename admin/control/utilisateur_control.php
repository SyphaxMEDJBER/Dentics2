<?php
require_once __DIR__ . '/../model/ConnexionDB.php';

use Admin\Model\ConnexionDB;

$db = ConnexionDB::getInstance();

// Ajout d'un dentiste
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'], $_POST['motdepasse'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['motdepasse'];

    // Vérifier si l'email existe déjà
    $check = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE LOWER(email) = LOWER(?)");
    $check->execute([$email]);
    if ($check->fetchColumn() > 0) {
        echo "❌ Cet email est déjà utilisé.";
        exit();
    }

    // Insérer dans utilisateur
    $stmt = $db->prepare("INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES (?, ?, ?, 'dentist')");
    $stmt->execute([$nom, $email, $mdp]);

    // Récupérer l'id généré
    $id_utilisateur = $db->lastInsertId();

    // Insérer dans la table dentist
    $stmt2 = $db->prepare("INSERT INTO dentist (id_utilisateur) VALUES (?)");
    $stmt2->execute([$id_utilisateur]);

    header("Location: ../templates/back/utilisateurs.php");
    exit();
}

// Suppression d'un client
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Supprimer les données liées dans la table client
    $stmt = $db->prepare("DELETE FROM client WHERE id_utilisateur = :id");
    $stmt->execute(['id' => $id]);

    // Ensuite, supprimer l'utilisateur
    $stmt = $db->prepare("DELETE FROM utilisateur WHERE id = :id AND role = 'client'");
    $stmt->execute(['id' => $id]);

    header("Location: ../templates/back/utilisateurs.php");
    exit();
}
