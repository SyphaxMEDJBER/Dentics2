<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$nom = $_SESSION['admin_nom'] ?? 'Invité';
?>

<?php include 'header.php'; ?>

<main>
    <section class="dashboard">
        <div class="dashboard-banner">
            <h1 class="dashboard-title">Bienvenue, Dr <?= htmlspecialchars($nom) ?> !</h1>
        </div>

        <p>Gérez les utilisateurs, les rendez-vous et consultez la FAQ.</p>
        <div class="dashboard-buttons">
            <a href="utilisateurs.php" class="btn">Gérer les Utilisateurs</a>
            <a href="rendez_vous.php" class="btn">Gérer les Rendez-vous</a>
            <a href="faq.php" class="btn">FAQ</a>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
