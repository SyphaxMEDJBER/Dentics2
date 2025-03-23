<?php
namespace Admin\Model;

require_once 'Utilisateur.php';

class Client extends Utilisateur {
    private string $photo;

    public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "", $photo = "") {
        parent::__construct($id, $nom, $email, $motDePasse, "client");
        $this->photo = $photo;
    }

    public function __get($prop) {
        if ($prop === "photo") return $this->photo;
        return parent::__get($prop);
    }

    public function __set($prop, $val) {
        if ($prop === "photo") $this->photo = $val;
        else parent::__set($prop, $val);
    }

    public function __toString(): string {
        return parent::__toString() . ", Photo : {$this->photo}";
    }
}
