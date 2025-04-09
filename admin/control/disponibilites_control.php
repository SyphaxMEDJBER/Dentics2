<?php
session_start(); // Nécessaire pour lire le token de session

require_once __DIR__ . '/../model/DisponibiliteManager.php';
require_once __DIR__ . '/../class/Disponibilite.php';

use Admin\Model\Disponibilite;
use Admin\Model\DisponibiliteManager;

$manager = new DisponibiliteManager();

// Ajout d'une disponibilité
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date'], $_POST['heure'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("❌ CSRF token invalide.");
    }

    $dispo = new Disponibilite(0, 1, $_POST['date'], $_POST['heure'], false);  // id_dentist = 1
    $manager->add($dispo);
    header("Location: /Dentics2/admin/disponibilites");

    exit();
}

// Suppression d'une disponibilité
if (isset($_GET['delete'])) {
    $manager->delete((int) $_GET['delete']);
    header("Location: /Dentics2/admin/disponibilites");

    exit();
}
