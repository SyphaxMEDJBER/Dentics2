<?php
namespace Admin\Model;

require_once 'Utilisateur.php';

/**
 * Summary of Client
 * 
 */

class Client extends Utilisateur {
    private string $photo;
    /**
     * Summary of __construct
     * Constructeur de la classe Client.
     * @param mixed $id l'id du client
     * @param mixed $nom nom du client
     * @param mixed $email adresse mail
     * @param mixed $motDePasse mot de passe de connexion
     * @param mixed $photo
     */
    public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "", $photo = "") {
        parent::__construct($id, $nom, $email, $motDePasse, "client");
        $this->photo = $photo;
    }
    /**
     * Summary of __get
     * Accesseur magique pour obtenir une propriété de l'objet Client.
     * @param string $prop Nom de la propriété demandée
     * @return mixed Valeur de la propriété demandé
     */
    public function __get($prop) {
        if ($prop === "photo") return $this->photo;
        return parent::__get($prop);
    }
    /**
     * Summary of __set
     *  Modifie dynamiquement la valeur d'une propriété de l'objet Client.
     * @param mixed $prop Nom de la propriété à modifier
     * @param mixed $val Nouvelle valeur à assigner à la propriété
     * @return void
     */
    public function __set($prop, $val) {
        if ($prop === "photo") $this->photo = $val;
        else parent::__set($prop, $val);
    }
    /**
     * Summary of __toString
     * @return string la chaine qui decrit le clients 'ses attributs'
     */
    public function __toString(): string {
        return parent::__toString() . ", Photo : {$this->photo}";
    }
}
