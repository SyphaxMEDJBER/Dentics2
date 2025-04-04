<?php
namespace Admin\Model;

require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/MessageContact.php';


use PDO;
/**
 * Summary of MessageContactManager
 */
class MessageContactManager {
    private PDO $db;
    /**
     * Summary of __construct
     */
    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }
    /**
     * Summary of getAllMessages
     * @return MessageContact[]
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
