<?php
require_once __DIR__ . '/../model/ConnexionDB.php';
use Admin\Model\ConnexionDB;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $motdepasse = trim($_POST['motdepasse'] ?? '');

    $db = ConnexionDB::getInstance();

    $stmt = $db->prepare("SELECT * FROM utilisateur WHERE email = :email AND role = 'dentist'");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $motdepasse === $user['mot_de_passe']) {
        // Connexion réussie → redirection avec données dans l'URL
        header("Location: ../templates/back/dashboard.php?nom=" . urlencode($user['nom']) . "&id=" . $user['id']);
        exit();
    } else {
        // Redirection vers login avec message d’erreur
        header("Location: ../templates/back/login.php?error=1");
        exit();
    }
}
