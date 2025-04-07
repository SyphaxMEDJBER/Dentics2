<?php
namespace Admin\Model;

require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/MessageContact.php';

use PDO;

/**
 * Classe permettant la gestion des messages de contact dans la base de données.
 */
class MessageContactManager {
    private PDO $db;

    /**
     * Initialise la connexion à la base de données via ConnexionDB.
     */
    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }

    /**
     * Récupère tous les messages de contact enregistrés en base, triés par date et heure d'envoi.
     *
     * @return MessageContact[] Liste des objets MessageContact
     */
    public function getAllMessages(): array {
        $messages = [];
        $sql = "SELECT * FROM MessageContact ORDER BY date_envoi DESC, heure_envoi DESC";
        $stmt = $this->db->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new MessageContact(
                $row['id_message'],
                $row['nom'],
                $row['email'],
                $row['message'],
                $row['date_envoi'],
                $row['heure_envoi']
            );
        }

        return $messages;
    }
}
