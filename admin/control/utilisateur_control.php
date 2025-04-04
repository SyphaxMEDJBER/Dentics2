<?php
require_once __DIR__ . '/../model/UtilisateurManager.php';

use Admin\Model\UtilisateurManager;

$manager = new UtilisateurManager();

// Ajout d’un dentiste
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'], $_POST['motdepasse'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['motdepasse'];

    if ($manager->emailExiste($email)) {
        echo "❌ Cet email est déjà utilisé.";
        exit();
    }

    $manager->ajouterDentiste($nom, $email, $mdp);
    header("Location: ../templates/back/utilisateurs.php");
    exit();
}

// Suppression d’un client
if (isset($_GET['id'])) {
    $manager->supprimerClient((int) $_GET['id']);
    header("Location: ../templates/back/utilisateurs.php");
    exit();
}
