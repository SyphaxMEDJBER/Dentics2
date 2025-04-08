<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/../../model/MessageContactManager.php';
require_once __DIR__ . '/../../class/MessageContact.php';

use Admin\Model\MessageContactManager;

include 'header.php';

$manager = new MessageContactManager();
$messages = $manager->getAllMessages();
?>

<main>
    <section class="messages-container">
        <h1>Messages reçus</h1>

        <?php if (empty($messages)): ?>
            <p>Aucun message trouvé.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Heure</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td><?= htmlspecialchars($msg->__get('nom')) ?></td>
                            <td><?= htmlspecialchars($msg->__get('email')) ?></td>
                            <td><?= nl2br(htmlspecialchars($msg->__get('message'))) ?></td>
                            <td><?= $msg->__get('date_envoi') ?></td>
                            <td><?= $msg->__get('heure_envoi') ?></td>
                            <td>
    <a href="mailto:<?= $msg->__get('email') ?>?subject=Réponse à votre message Dentics&body=Bonjour <?= $msg->__get('nom') ?>," class="btn">📧 Répondre</a>
</td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>

<?php include 'footer.php'; ?>
