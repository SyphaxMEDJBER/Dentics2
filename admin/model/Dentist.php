<?php
namespace Admin\Model;

require_once 'Utilisateur.php';

class Dentist extends Utilisateur {

    public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "") {
        parent::__construct($id, $nom, $email, $motDePasse, "dentist");
    }

    public function __toString(): string {
        return parent::__toString() . " (Dentiste)";
    }
}
