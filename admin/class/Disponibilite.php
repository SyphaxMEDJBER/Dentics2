<?php
namespace Admin\Model;
/**
 * Summary of Disponibilite
 */
class Disponibilite {
    private int $id_dispo;
    private int $id_dentist;
    private string $date_dispo;
    private string $heure_dispo;
    private $est_reserve; // booléen, sans typage strict
    /**
     * Summary of __construct
     * @param mixed $id_dispo
     * @param mixed $id_dentist
     * @param mixed $date_dispo
     * @param mixed $heure_dispo
     * @param mixed $est_reserve
     */
    public function __construct($id_dispo = 0, $id_dentist = 0, $date_dispo = "", $heure_dispo = "", $est_reserve = false) {
        $this->id_dispo = $id_dispo;
        $this->id_dentist = $id_dentist;
        $this->date_dispo = $date_dispo;
        $this->heure_dispo = $heure_dispo;
        $this->est_reserve = (bool) $est_reserve;
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
        return "Disponibilité #{$this->id_dispo} - Dentiste {$this->id_dentist} : {$this->date_dispo} à {$this->heure_dispo}";
    }
}
