<?php
namespace Admin\Model;

require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/Disponibilite.php';


use PDO;

class DisponibiliteManager {
    private PDO $db;

    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }

    public function add(Disponibilite $dispo): void {
        $stmt = $this->db->prepare("INSERT INTO disponibilite (id_dentist, date_dispo, heure_dispo, est_reserve) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $dispo->__get('id_dentist'),
            $dispo->__get('date_dispo'),
            $dispo->__get('heure_dispo'),
            $dispo->__get('est_reserve') ? 1 : 0
        ]);
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM disponibilite ORDER BY date_dispo, heure_dispo");
        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Disponibilite(
                $row['id_dispo'],
                $row['id_dentist'],
                $row['date_dispo'],
                $row['heure_dispo'],
                $row['est_reserve']
            );
        }

        return $result;
    }

 
    public function delete(int $id): void {
      $stmt = $this->db->prepare("DELETE FROM disponibilite WHERE id_dispo = :id AND est_reserve = FALSE");
      $stmt->execute([':id' => $id]);
    }
    
  }


