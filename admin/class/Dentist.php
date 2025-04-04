<?php
namespace Admin\Model;

require_once 'Utilisateur.php';

/**
 * Summary of Dentist
 */
class Dentist extends Utilisateur {
    /**
     * Summary of __construct
     * @param mixed $id
     * @param mixed $nom
     * @param mixed $email
     * @param mixed $motDePasse
     */
 
     public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "") {
        parent::__construct($id, $nom, $email, $motDePasse, "dentist");
    }
    /**
     * Summary of __toString
     * @return string
     */
    public function __toString(): string {
        return parent::__toString() . " (Dentiste)";
    }
}
