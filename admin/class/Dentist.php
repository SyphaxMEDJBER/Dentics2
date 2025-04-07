<?php
namespace Admin\Model;

require_once 'Utilisateur.php';

/**
 * Summary of Dentist
 */
class Dentist extends Utilisateur {
    /**
     * Summary of __construct
     * @param mixed $id id de dentiste
     * @param mixed $nom nom de dentiste
     * @param mixed $email  mail de dentiste
     * @param mixed $motDePasse mot de passe de cnx 
     */
 
     public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "") {
        parent::__construct($id, $nom, $email, $motDePasse, "dentist");
    }
    /**
     * Summary of __toString
     * @return string la chaine qui represente le dentiste 
     */
    public function __toString(): string {
        return parent::__toString() . " (Dentiste)";
    }
}
