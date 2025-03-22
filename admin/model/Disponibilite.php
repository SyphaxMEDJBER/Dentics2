<?php
namespace Admin\Model;

class Disponibilite {
    private int $id_dispo;
    private int $id_dentist;
    private string $date_dispo;
    private string $heure_dispo;

    public function __construct($id_dispo = 0, $id_dentist = 0, $date_dispo = "", $heure_dispo = "") {
        $this->id_dispo = $id_dispo;
        $this->id_dentist = $id_dentist;
        $this->date_dispo = $date_dispo;
        $this->heure_dispo = $heure_dispo;
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
        return "Disponibilité #{$this->id_dispo} - Dentiste {$this->id_dentist} : {$this->date_dispo} à {$this->heure_dispo}";
    }
}
