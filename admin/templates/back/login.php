<?php
session_start();
require_once __DIR__ . '/../../model/ConnexionDB.php';

use Admin\Model\ConnexionDB;

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';

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
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Dentics Admin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <h2>Connexion Administrateur</h2>

        <?php if ($error): ?>
            <p class="login-error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Email :</label>
            <input type="email" name="email" required>

            <label for="motdepasse">Mot de passe :</label>
            <input type="password" name="motdepasse" required>

            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>
</body>
</html>
