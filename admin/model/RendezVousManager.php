<?php
namespace Admin\Model;



require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/RendezVous.php';


use PDO;

class RendezVousManager {
    private PDO $db;

    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }

    public function getAll(): array {
        $liste = [];

        $sql = "SELECT * FROM RendezVous ORDER BY date_rdv DESC, heure_rdv DESC";
        $stmt = $this->db->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = new RendezVous(
                $row['id_rdv'],
                $row['nom'],
                $row['email'],
                $row['telephone'],
                $row['id_dentist'],
                $row['date_rdv'],
                $row['heure_rdv'],
                $row['statut']
            );
        }

        return $liste;
    }
}
