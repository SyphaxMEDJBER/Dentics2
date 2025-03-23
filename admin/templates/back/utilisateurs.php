<?php
session_start();
require_once __DIR__ . '/../../model/UtilisateurManager.php';
require_once __DIR__ . '/../../class/Utilisateur.php';

use Admin\Model\UtilisateurManager;

include 'header.php';

$manager = new UtilisateurManager();
$utilisateurs = $manager->getAll();
?>

<main>
    <section class="utilisateurs">
        <h2>Liste des utilisateurs</h2>

        <?php if (empty($utilisateurs)): ?>
            <p>Aucun utilisateur enregistré.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $u): ?>
                        <tr>
                            <td><?= $u->__get('id') ?></td>
                            <td><?= htmlspecialchars($u->__get('nom')) ?></td>
                            <td><?= htmlspecialchars($u->__get('email')) ?></td>
                            <td><?= $u->__get('role') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>

<?php include 'footer.php'; ?>
