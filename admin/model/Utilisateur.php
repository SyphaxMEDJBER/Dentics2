<?php
namespace Admin\Model;

class Utilisateur {
    private int $id;
    private string $nom;
    private string $email;
    private string $motDePasse;
    private string $role;

    public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "", $role = "client") {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
    }

    public function __get($prop) {
        return $this->$prop;
    }

    public function __set($prop, $val) {
        if (property_exists($this, $prop)) {
            $this->$prop = $val;
        }
    }

    public function __toString(): string {
        return "Utilisateur : {$this->id}, {$this->nom}, {$this->email}, {$this->role}";
    }
}
