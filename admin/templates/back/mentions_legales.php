<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include 'header.php';
?>

<main>
    <section class="mentions-legales">
        <h2>Mentions Légales</h2>
        <p><strong>Nom du site :</strong> Dentics</p>
        <p><strong>Responsable de publication :</strong> Dr. Bernard</p>
        <p><strong>Email de contact :</strong> contact@dentics.fr</p>
        <p><strong>Hébergeur :</strong> Université d'Avignon - Serveur pédago</p>
        <p><strong>Adresse :</strong> 74 Rue Louis Pasteur, 84000 Avignon, France</p>
        <p><strong>Utilisation :</strong> Ce site est destiné à la gestion des rendez-vous et des utilisateurs pour les dentistes de la plateforme Dentics.</p>
        <p><strong>Propriété intellectuelle :</strong> Tous les contenus présents sur ce site sont protégés. Toute reproduction est interdite sans autorisation préalable.</p>
    </section>
</main>

<?php include 'footer.php'; ?>
