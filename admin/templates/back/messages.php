<?php
require_once __DIR__ . '/../../model/MessageContact.php';
include 'header.php';

use Admin\Model\MessageContact;

try {
    $messages = MessageContact::getAll();
} catch (PDOException $e) {
    echo "<p>Erreur lors de la récupération des messages : " . $e->getMessage() . "</p>";
    $messages = [];
}
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
                            <td><?= htmlspecialchars($msg->nom) ?></td>
                            <td><?= htmlspecialchars($msg->email) ?></td>
                            <td><?= nl2br(htmlspecialchars($msg->message)) ?></td>
                            <td><?= $msg->date_envoi ?></td>
                            <td><?= $msg->heure_envoi ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>

<?php include 'footer.php'; ?>
