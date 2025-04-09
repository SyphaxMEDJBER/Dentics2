<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: /Dentics2/admin/login");
    exit();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];

require_once __DIR__ . '/../../model/UtilisateurManager.php';
require_once __DIR__ . '/../../class/Utilisateur.php';

use Admin\Model\UtilisateurManager;

include 'header.php';

$manager = new UtilisateurManager();
$utilisateurs = $manager->getAll();
?>

<main>
    <section class="utilisateurs">
        <h2>Ajouter un dentiste</h2>
        <form method="POST" action="/Dentics2/admin/utilisateur/add">
            <label>Nom : <input type="text" name="nom" required></label>
            <label>Email : <input type="email" name="email" required></label>
            <label>Mot de passe : <input type="text" name="motdepasse" required></label>
            <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
            <button type="submit" class="btn">Ajouter</button>
        </form>

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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $u): ?>
                        <tr>
                            <td><?= $u->__get('id') ?></td>
                            <td><?= htmlspecialchars($u->__get('nom')) ?></td>
                            <td><?= htmlspecialchars($u->__get('email')) ?></td>
                            <td><?= $u->__get('role') ?></td>
                            <td>
                                <?php if ($u->__get('role') === 'client'): ?>
                                    <a href="/Dentics2/admin/utilisateur/delete/<?= $u->__get('id') ?>?csrf_token=<?= $csrf ?>"
                                       onclick="return confirm('Confirmer la suppression de ce client ?')">🗑 Supprimer</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>

<?php include 'footer.php'; ?>
