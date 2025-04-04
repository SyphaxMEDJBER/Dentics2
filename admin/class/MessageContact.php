<?php
namespace Admin\Model;
/**
 * Summary of MessageContact
 */
class MessageContact {
    private int $id_message;
    private string $nom;
    private string $email;
    private string $message;
    private string $date_envoi;
    private string $heure_envoi;
    /**
     * Summary of __construct
     * @param mixed $id_message
     * @param mixed $nom
     * @param mixed $email
     * @param mixed $message
     * @param mixed $date_envoi
     * @param mixed $heure_envoi
     */
    public function __construct($id_message = 0, $nom = "", $email = "", $message = "", $date_envoi = "", $heure_envoi = "") {
        $this->id_message = $id_message;
        $this->nom = $nom;
        $this->email = $email;
        $this->message = $message;
        $this->date_envoi = $date_envoi;
        $this->heure_envoi = $heure_envoi;
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
        return "[Message #{$this->id_message}] {$this->nom} ({$this->email}) : {$this->message} — le {$this->date_envoi} à {$this->heure_envoi}";
    }
}
