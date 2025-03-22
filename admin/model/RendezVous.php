<?php
namespace Admin\Model;

class RendezVous {
    private int $id_rdv;
    private string $nom;
    private string $email;
    private string $telephone;
    private int $id_dentist;
    private string $date_rdv;
    private string $heure_rdv;

    public function __construct($id_rdv = 0, $nom = "", $email = "", $telephone = "", $id_dentist = 0, $date_rdv = "", $heure_rdv = "") {
        $this->id_rdv = $id_rdv;
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->id_dentist = $id_dentist;
        $this->date_rdv = $date_rdv;
        $this->heure_rdv = $heure_rdv;
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
        return "RDV {$this->id_rdv} - {$this->nom} ({$this->email}) le {$this->date_rdv} à {$this->heure_rdv}";
    }
}
