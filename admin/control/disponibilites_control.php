<?php
session_start();

require_once __DIR__ . '/../model/DisponibiliteManager.php';
require_once __DIR__ . '/../class/Disponibilite.php';

use Admin\Model\Disponibilite;
use Admin\Model\DisponibiliteManager;

$manager = new DisponibiliteManager();

//  Ajout d'une disponibilité
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date'], $_POST['heure'])) {
    $nouvelleDispo = new Disponibilite(0, 1, $_POST['date'], $_POST['heure'], false); // id_dentist = 1 (test)
    $manager->add($nouvelleDispo);
    header("Location: ../templates/back/disponibilites.php");
    exit();
}

// Suppression d'une disponibilité
if (isset($_GET['delete'])) {
    $manager->delete((int) $_GET['delete']);
    header("Location: ../templates/back/disponibilites.php");
    exit();
}
