<?php
session_start();
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
        $_SESSION['user'] = [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
        header("Location: ../templates/back/dashboard.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Email ou mot de passe incorrect.";
        header("Location: ../templates/back/login.php");
        exit();
    }
}
