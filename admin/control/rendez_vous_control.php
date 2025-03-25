<?php
use Admin\Model\ConnexionDB;

require_once __DIR__ . '/../model/ConnexionDB.php';

$db = ConnexionDB::getInstance();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    // Récupérer les infos du rendez-vous
    $stmtRdv = $db->prepare("SELECT id_dentist, date_rdv, heure_rdv FROM rendezvous WHERE id_rdv = :id");
    $stmtRdv->execute(['id' => $id]);
    $rdv = $stmtRdv->fetch(PDO::FETCH_ASSOC);

    if ($rdv) {
        $id_dentist = $rdv['id_dentist'];
        $date = $rdv['date_rdv'];
        $heure = $rdv['heure_rdv'];

        if ($action === 'confirmer') {
            // 1. Confirmer le rendez-vous
            $stmt = $db->prepare("UPDATE rendezvous SET statut = 'confirmé' WHERE id_rdv = :id");
            $stmt->execute(['id' => $id]);

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
        }

        elseif ($action === 'annuler') {
            // 1. Supprimer le rendez-vous
            $stmt = $db->prepare("DELETE FROM rendezvous WHERE id_rdv = :id");
            $stmt->execute(['id' => $id]);

            // 2. Libérer la disponibilité
            $updateDispo = $db->prepare("UPDATE disponibilite 
                SET est_reserve = FALSE 
                WHERE id_dentist = :dentist 
                  AND date_dispo = :date 
                  AND heure_dispo = :heure");
            $updateDispo->execute([
                'dentist' => $id_dentist,
                'date' => $date,
                'heure' => $heure
            ]);
        }
    }
}

header("Location: ../templates/back/rendez_vous.php");
exit();
