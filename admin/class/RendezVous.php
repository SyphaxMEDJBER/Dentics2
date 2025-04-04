<?php

namespace Admin\Model;
/**
 * Summary of RendezVous
 */
class RendezVous {
    private int $id_rdv;
    private string $nom;
    private string $email;
    private string $telephone;
    private int $id_dentist;
    private string $date_rdv;
    private string $heure_rdv;
    private string $statut; // <-- Ajouté
    /**
     * Summary of __construct
     * @param mixed $id_rdv
     * @param mixed $nom
     * @param mixed $email
     * @param mixed $telephone
     * @param mixed $id_dentist
     * @param mixed $date_rdv
     * @param mixed $heure_rdv
     * @param mixed $statut
     */
    public function __construct($id_rdv = 0, $nom = "", $email = "", $telephone = "", $id_dentist = 0, $date_rdv = "", $heure_rdv = "", $statut = "en attente") {
        $this->id_rdv = $id_rdv;
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->id_dentist = $id_dentist;
        $this->date_rdv = $date_rdv;
        $this->heure_rdv = $heure_rdv;
        $this->statut = $statut; // <-- Ajouté
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
        return "RDV {$this->id_rdv} - {$this->nom} ({$this->email}) le {$this->date_rdv} à {$this->heure_rdv} - Statut : {$this->statut}";
    }
}
