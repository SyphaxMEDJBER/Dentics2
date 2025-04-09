<?php
session_start(); // DÉPLACÉ EN HAUT
$root = "/Dentics2/admin";


require_once __DIR__ . '/../model/UtilisateurManager.php';

use Admin\Model\UtilisateurManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $motdepasse = trim($_POST['motdepasse'] ?? '');

    $manager = new UtilisateurManager();
    $user = $manager->getByEmail($email);

    if ($user && password_verify($motdepasse, $user->__get('motDePasse')) && $user->__get('role') === 'dentist') {
        // Connexion réussie
        $_SESSION['admin_id'] = $user->__get('id');
        $_SESSION['admin_nom'] = $user->__get('nom');
        setcookie("nom_admin", $user->__get('nom'), time() + (86400 * 7), "/"); // 7 jours
        header("Location: $root/dashboard");


        exit();
    } else {
        $_SESSION['login_error'] = "Email ou mot de passe incorrect.";
        header("Location: ../templates/back/login.php");
        exit();
    }
}
