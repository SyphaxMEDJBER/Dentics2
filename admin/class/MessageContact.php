<?php
namespace Admin\Model;

class MessageContact {
    private int $id_message;
    private string $nom;
    private string $email;
    private string $message;
    private string $date_envoi;
    private string $heure_envoi;

    public function __construct($id_message = 0, $nom = "", $email = "", $message = "", $date_envoi = "", $heure_envoi = "") {
        $this->id_message = $id_message;
        $this->nom = $nom;
        $this->email = $email;
        $this->message = $message;
        $this->date_envoi = $date_envoi;
        $this->heure_envoi = $heure_envoi;
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
        return "[Message #{$this->id_message}] {$this->nom} ({$this->email}) : {$this->message} — le {$this->date_envoi} à {$this->heure_envoi}";
    }
}
