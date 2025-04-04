<?php
namespace Admin\Model;

require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/Disponibilite.php';


use PDO;
/**
 * Summary of DisponibiliteManager
 */
class DisponibiliteManager {
    private PDO $db;
    /**
     * Summary of __construct
     */
    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }
    /**
     * Summary of add
     * @param \Admin\Model\Disponibilite $dispo
     * @return void
     */
    public function add(Disponibilite $dispo): void {
        $stmt = $this->db->prepare("INSERT INTO disponibilite (id_dentist, date_dispo, heure_dispo, est_reserve) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $dispo->__get('id_dentist'),
            $dispo->__get('date_dispo'),
            $dispo->__get('heure_dispo'),
            $dispo->__get('est_reserve') ? 1 : 0
        ]);
    }
    /**
     * Summary of getAll
     * @return Disponibilite[]
     */
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

    /**
     * Summary of delete
     * @param int $id
     * @return void
     */
    public function delete(int $id): void {
      $stmt = $this->db->prepare("DELETE FROM disponibilite WHERE id_dispo = :id AND est_reserve = FALSE");
      $stmt->execute([':id' => $id]);
    }
    
  }


