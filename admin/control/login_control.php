<?php
require_once __DIR__ . '/../model/UtilisateurManager.php';

use Admin\Model\UtilisateurManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $motdepasse = trim($_POST['motdepasse'] ?? '');

    $manager = new UtilisateurManager();
    $user = $manager->getByEmail($email);

    if ($user && password_verify($motdepasse, $user->__get('motDePasse')) && $user->__get('role') === 'dentist') {
        // Connexion réussie → redirection avec nom et id dans l'URL
        header("Location: ../templates/back/dashboard.php?nom=" . urlencode($user->__get('nom')) . "&id=" . $user->__get('id'));
        exit();
    }
     else {
        header("Location: ../templates/back/login.php?error=1");
        exit();
    }
}
