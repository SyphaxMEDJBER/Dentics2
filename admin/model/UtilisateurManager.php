<?php
namespace Admin\Model;

require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/Utilisateur.php';


use PDO;

class UtilisateurManager {
    private PDO $db;

    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }

    public function getAll(): array {
        $liste = [];
        $sql = "SELECT * FROM utilisateur";
        $stmt = $this->db->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = new Utilisateur(
                $row['id'],
                $row['nom'],
                $row['email'],
                $row['mot_de_passe'],
                $row['role']
            );
        }

        return $liste;
    }
}
