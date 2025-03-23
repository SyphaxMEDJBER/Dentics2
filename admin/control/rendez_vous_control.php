<?php
use Admin\Model\ConnexionDB;

require_once __DIR__ . '/../model/ConnexionDB.php';

$db = ConnexionDB::getInstance();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'confirmer') {
        $stmt = $db->prepare("UPDATE rendezvous SET statut = 'confirmé' WHERE id_rdv = :id");
        $stmt->execute(['id' => $id]);
    } elseif ($action === 'annuler') {
        $stmt = $db->prepare("DELETE FROM rendezvous WHERE id_rdv = :id");
        $stmt->execute(['id' => $id]);
    }
}

header("Location: ../templates/back/rendez_vous.php");
exit();
