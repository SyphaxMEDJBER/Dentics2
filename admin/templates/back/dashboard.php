<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'dentist') {
    header("Location: login.php");
    exit();
}

    include 'header.php'; ?>

<main>
    <section class="dashboard">
    <div class="dashboard-banner">
    <img src="../../../images/image&.jpg" alt="Accueil Admin">
    <h1 class="dashboard-title">Bienvenue sur l’espace Admin</h1>
</div>

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
