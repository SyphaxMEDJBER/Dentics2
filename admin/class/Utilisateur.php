<?php
namespace Admin\Model;

/**
 * Classe représentant un utilisateur du site.
 */
class Utilisateur {
    private int $id;
    private string $nom;
    private string $email;
    private string $motDePasse;
    private string $role;

    /**
     * Constructeur de la classe Utilisateur.
     *
     * @param int $id Identifiant de l'utilisateur
     * @param string $nom Nom de l'utilisateur
     * @param string $email Email de l'utilisateur
     * @param string $motDePasse Mot de passe de l'utilisateur
     * @param string $role Rôle de l'utilisateur (client, dentist, admin, etc.)
     */
    public function __construct($id = 0, $nom = "", $email = "", $motDePasse = "", $role = "client") {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
    }

    /**
     * Permet de récupérer dynamiquement la valeur d'une propriété.
     *
     * @param string $prop Nom de la propriété
     * @return mixed Valeur de la propriété
     */
    public function __get($prop) {
        return $this->$prop;
    }

    /**
     * Permet de définir dynamiquement la valeur d'une propriété.
     *
     * @param string $prop Nom de la propriété
     * @param mixed $val Valeur à assigner
     * @return void
     */
    public function __set($prop, $val) {
        if (property_exists($this, $prop)) {
            $this->$prop = $val;
        }
    }

    /**
     * Retourne une chaîne représentant l'utilisateur.
     *
     * @return string Informations principales de l'utilisateur
     */
    public function __toString(): string {
        return "Utilisateur : {$this->id}, {$this->nom}, {$this->email}, {$this->role}";
    }
}
