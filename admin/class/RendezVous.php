<?php

namespace Admin\Model;

/**
 * Représente un rendez-vous pris avec un dentiste.
 */
class RendezVous {
    private int $id_rdv;
    private string $nom;
    private string $email;
    private string $telephone;
    private int $id_dentist;
    private string $date_rdv;
    private string $heure_rdv;
    private string $statut;

    /**
     * Initialise un objet RendezVous.
     *
     * @param int $id_rdv Identifiant du rendez-vous
     * @param string $nom Nom du client
     * @param string $email Email du client
     * @param string $telephone Téléphone du client
     * @param int $id_dentist ID du dentiste concerné
     * @param string $date_rdv Date du rendez-vous
     * @param string $heure_rdv Heure du rendez-vous
     * @param string $statut Statut du rendez-vous (par défaut "en attente")
     */
    public function __construct($id_rdv = 0, $nom = "", $email = "", $telephone = "", $id_dentist = 0, $date_rdv = "", $heure_rdv = "", $statut = "en attente") {
        $this->id_rdv = $id_rdv;
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->id_dentist = $id_dentist;
        $this->date_rdv = $date_rdv;
        $this->heure_rdv = $heure_rdv;
        $this->statut = $statut;
    }

    /**
     * Accède à une propriété de l'objet.
     *
     * @param string $prop Nom de la propriété
     * @return mixed Valeur de la propriété
     */
    public function __get($prop) {
        return $this->$prop;
    }

    /**
     * Modifie une propriété de l'objet si elle existe.
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
     * Retourne une représentation textuelle du rendez-vous.
     *
     * @return string Description du rendez-vous
     */
    public function __toString(): string {
        return "RDV {$this->id_rdv} - {$this->nom} ({$this->email}) le {$this->date_rdv} à {$this->heure_rdv} - Statut : {$this->statut}";
    }
}
