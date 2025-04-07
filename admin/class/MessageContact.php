<?php
namespace Admin\Model;

/**
 * Représente un message de contact envoyé par un utilisateur via le formulaire.
 */
class MessageContact {
    private int $id_message;
    private string $nom;
    private string $email;
    private string $message;
    private string $date_envoi;
    private string $heure_envoi;

    /**
     * Initialise un nouvel objet MessageContact.
     *
     * @param int $id_message Identifiant du message
     * @param string $nom Nom de l'expéditeur
     * @param string $email Email de l'expéditeur
     * @param string $message Contenu du message
     * @param string $date_envoi Date d'envoi du message
     * @param string $heure_envoi Heure d'envoi du message
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
     * Permet d'accéder dynamiquement aux propriétés de l'objet.
     *
     * @param string $prop Nom de la propriété
     * @return mixed Valeur de la propriété demandée
     */
    public function __get($prop) {
        return $this->$prop;
    }

    /**
     * Modifie dynamiquement la valeur d'une propriété de l'objet.
     *
     * @param string $prop Nom de la propriété à modifier
     * @param mixed $val Nouvelle valeur à assigner
     * @return void
     */
    public function __set($prop, $val) {
        if (property_exists($this, $prop)) {
            $this->$prop = $val;
        }
    }

    /**
     * Retourne une représentation textuelle du message.
     *
     * @return string Chaîne formatée contenant les informations du message
     */
    public function __toString(): string {
        return "[Message #{$this->id_message}] {$this->nom} ({$this->email}) : {$this->message} — le {$this->date_envoi} à {$this->heure_envoi}";
    }
}
