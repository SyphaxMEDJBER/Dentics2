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

    // Vérification simple (sans hash)
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
    <title>Connexion - Admin Dentics</title>
    <link rel="stylesheet" href="../templates/css/login.css"> <!-- si tu as un style -->
</head>
<body>
    <h2>Connexion Administrateur</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email :</label>
        <input type="email" name="email" required>

        <label>Mot de passe :</label>
        <input type="password" name="motdepasse" required>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
