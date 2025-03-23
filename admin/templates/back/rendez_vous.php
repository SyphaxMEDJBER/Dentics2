<?php
session_start();
require_once __DIR__ . '/../../model/RendezVousManager.php';
require_once __DIR__ . '/../../class/RendezVous.php';

use Admin\Model\RendezVousManager;

include 'header.php';

$manager = new RendezVousManager();
$rdvs = $manager->getAll();
?>

<main>
    <section class="appointments-container">
        <h1>Liste des Rendez-vous</h1>
        <?php if (empty($rdvs)): ?>
            <p>Aucun rendez-vous trouvé.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Dentiste</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rdvs as $rdv): ?>
                        <tr>
                            <td><?= $rdv->__get('id_rdv') ?></td>
                            <td><?= htmlspecialchars($rdv->__get('nom')) ?></td>
                            <td><?= htmlspecialchars($rdv->__get('email')) ?></td>
                            <td><?= htmlspecialchars($rdv->__get('telephone')) ?></td>
                            <td><?= $rdv->__get('id_dentist') ?></td>
                            <td><?= $rdv->__get('date_rdv') ?></td>
                            <td><?= $rdv->__get('heure_rdv') ?></td>
                            <td><?= $rdv->__get('statut') ?></td>
                            <td>
                                <a href="../../control/rendez_vous_control.php?action=confirmer&id=<?= $rdv->__get('id_rdv') ?>">✔️</a>
                                <a href="../../control/rendez_vous_control.php?action=annuler&id=<?= $rdv->__get('id_rdv') ?>">🗑</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>

<?php include 'footer.php'; ?>
