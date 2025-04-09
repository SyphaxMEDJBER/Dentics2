<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
$root = "/Dentics2/admin";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin - Dentics</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #004080, #0077cc);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .container {
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .left img {
            width: 220px;
            height: auto;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        form {
            display: flex;
            flex-direction: column;
            width: 300px;
        }

        h2 {
            margin-bottom: 1.5rem;
            color: white;
            font-size: 26px;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            border: none;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        button {
            background-color: white;
            color: #004080;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e0e0e0;
        }

        .login-error {
            color: #ffaaaa;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="https://img.icons8.com/clouds/500/tooth.png" alt="Dentist">
        </div>

        <div class="right">
            <h2>Connexion Administrateur</h2>

            <?php if (!empty($error)): ?>
                <p class="login-error"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" action="<?= $root ?>/control/login_control.php">
                <label>Email :</label>
                <input type="email" name="email" required>

                <label>Mot de passe :</label>
                <input type="password" name="motdepasse" required>

                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
