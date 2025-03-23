<?php
require_once __DIR__ . '/../../model/DisponibiliteManager.php';
require_once __DIR__ . '/../../class/Disponibilite.php';

use Admin\Model\DisponibiliteManager;

include 'header.php';

$manager = new DisponibiliteManager();
$disponibilites = $manager->getAll();
?>

<main>
    <section class="disponibilites">
        <h2>Ajouter une disponibilité</h2>
        <form method="POST" action="../../control/disponibilites_control.php">
            <label>Date : <input type="date" name="date" required></label>
            <label>Heure : <input type="time" name="heure" required></label>
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
                                <a href="../../control/disponibilites_control.php?delete=<?= $d->__get('id_dispo') ?>" onclick="return confirm('Confirmer la suppression ?')">🗑 Supprimer</a>
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
