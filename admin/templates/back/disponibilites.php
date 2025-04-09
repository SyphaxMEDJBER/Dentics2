<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];

require_once __DIR__ . '/../../model/DisponibiliteManager.php';
require_once __DIR__ . '/../../class/Disponibilite.php';

use Admin\Model\DisponibiliteManager;

$manager = new DisponibiliteManager();
$disponibilites = $manager->getAll();

include 'header.php';
?>

<main>
    <section class="disponibilites">
        <h2>Ajouter une disponibilité</h2>
        <form method="POST" action="/Dentics2/admin/control/disponibilites_control.php">
            <label>Date : <input type="date" name="date" required></label>
            <label>Heure : <input type="time" name="heure" required></label>
            <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
            <button type="submit">Ajouter</button>
        </form>

        <h2>Liste des disponibilités</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Réservé ?</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($disponibilites as $d): ?>
                    <tr>
                        <td><?= $d->__get('id_dispo') ?></td>
                        <td><?= $d->__get('date_dispo') ?></td>
                        <td><?= $d->__get('heure_dispo') ?></td>
                        <td><?= $d->__get('est_reserve') ? 'Oui' : 'Non' ?></td>
                        <td>
                            <?php if ((bool)$d->__get('est_reserve') === false): ?>
                                <a href="/Dentics2/admin/control/disponibilites_control.php?delete=<?= $d->__get('id_dispo') ?>&csrf_token=<?= $csrf ?>" onclick="return confirm('Confirmer la suppression ?')">🗑 Supprimer</a>
                            <?php else: ?>
                                Non supprimable
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'footer.php'; ?>
