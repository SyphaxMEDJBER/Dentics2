<?php
namespace Admin\Model;
/**
 * Summary of Utilisateur
 */
class Utilisateur {
    private int $id;
    private string $nom;
    private string $email;
    private string $motDePasse;
    private string $role;
    /**
     * Summary of __construct
     * @param mixed $id
     * @param mixed $nom
     * @param mixed $email
     * @param mixed $motDePasse
     * @param mixed $role
     */
    public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "", $role = "client") {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
    }
    /**
     * Summary of __get
     * @param mixed $prop
     */
    public function __get($prop) {
        return $this->$prop;
    }
    /**
     * Summary of __set
     * @param mixed $prop
     * @param mixed $val
     * @return void
     */
    public function __set($prop, $val) {
        if (property_exists($this, $prop)) {
            $this->$prop = $val;
        }
    }
    /**
     * Summary of __toString
     * @return string
     */
    public function __toString(): string {
        return "Utilisateur : {$this->id}, {$this->nom}, {$this->email}, {$this->role}";
    }
}
