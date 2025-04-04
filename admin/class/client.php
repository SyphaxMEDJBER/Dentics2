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
     * @param mixed $id
     * @param mixed $nom
     * @param mixed $email
     * @param mixed $motDePasse
     * @param mixed $photo
     */
    public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "", $photo = "") {
        parent::__construct($id, $nom, $email, $motDePasse, "client");
        $this->photo = $photo;
    }
    /**
     * Summary of __get
     * @param mixed $prop
     */
    public function __get($prop) {
        if ($prop === "photo") return $this->photo;
        return parent::__get($prop);
    }
    /**
     * Summary of __set
     * @param mixed $prop
     * @param mixed $val
     * @return void
     */
    public function __set($prop, $val) {
        if ($prop === "photo") $this->photo = $val;
        else parent::__set($prop, $val);
    }
    /**
     * Summary of __toString
     * @return string
     */
    public function __toString(): string {
        return parent::__toString() . ", Photo : {$this->photo}";
    }
}
