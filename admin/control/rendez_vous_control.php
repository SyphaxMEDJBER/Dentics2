<?php
session_start();

require_once __DIR__ . '/../model/RendezVousManager.php';

use Admin\Model\RendezVousManager;

$manager = new RendezVousManager();

if (isset($_GET['action'], $_GET['id'])) {
    if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        die("❌ CSRF token invalide.");
    }

    $id = (int) $_GET['id'];
    $action = $_GET['action'];

    if ($action === 'confirmer') {
        $manager->confirmerRendezVous($id);
    } elseif ($action === 'annuler') {
        $manager->annulerRendezVous($id);
    }
}

// Redirection vers l'URL propre avec rewriting
header("Location: /Dentics2/admin/rendez-vous");
exit();
