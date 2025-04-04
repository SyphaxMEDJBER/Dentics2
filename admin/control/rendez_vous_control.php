<?php
require_once __DIR__ . '/../model/RendezVousManager.php';

use Admin\Model\RendezVousManager;

$manager = new RendezVousManager();

if (isset($_GET['action'], $_GET['id'])) {
    $id = (int) $_GET['id'];
    $action = $_GET['action'];

    if ($action === 'confirmer') {
        $manager->confirmerRendezVous($id);
    } elseif ($action === 'annuler') {
        $manager->annulerRendezVous($id);
    }
}

// 2. Marquer la disponibilité comme réservée
$updateDispo = $db->prepare("UPDATE disponibilite 
    SET est_reserve = TRUE 
    WHERE id_dentist = :dentist 
      AND date_dispo = :date 
      AND heure_dispo = :heure");
$updateDispo->execute([
    'dentist' => $id_dentist,
    'date' => $date,
    'heure' => $heure
]);

header("Location: ../templates/back/rendez_vous.php");
exit();
