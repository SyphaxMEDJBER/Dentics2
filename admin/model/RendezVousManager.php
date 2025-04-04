<?php
namespace Admin\Model;



require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/RendezVous.php';
$db = ConnexionDB::getInstance();

use PDO;
/**
 * Summary of RendezVousManager
 */
class RendezVousManager {
    private PDO $db;
    /**
     * Summary of __construct
     */
    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }
    /**
     * Summary of getAll
     * @return RendezVous[]
     */
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








    public function confirmerRendezVous(int $id): void {
        // 1. Récupérer rdv
        $stmt = $this->db->prepare("SELECT id_dentist, date_rdv, heure_rdv FROM rendezvous WHERE id_rdv = :id");
        $stmt->execute(['id' => $id]);
        $rdv = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($rdv) {
            // 2. Mettre à jour le statut du RDV
            $stmt = $this->db->prepare("UPDATE rendezvous SET statut = 'confirmé' WHERE id_rdv = :id");
            $stmt->execute(['id' => $id]);
    
            // 3. Marquer la disponibilité correspondante comme réservée
            $stmt = $this->db->prepare("UPDATE disponibilite 
                SET est_reserve = TRUE 
                WHERE id_dentist = :dentist AND date_dispo = :date AND heure_dispo = :heure");
            $stmt->execute([
                'dentist' => $rdv['id_dentist'],
                'date' => $rdv['date_rdv'],
                'heure' => $rdv['heure_rdv']
            ]);
        }
    }
    
    public function annulerRendezVous(int $id): void {
        $stmt = $this->db->prepare("SELECT id_dentist, date_rdv, heure_rdv FROM rendezvous WHERE id_rdv = :id");
        $stmt->execute(['id' => $id]);
        $rdv = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($rdv) {
            // Supprimer le rendez-vous
            $stmt = $this->db->prepare("DELETE FROM rendezvous WHERE id_rdv = :id");
            $stmt->execute(['id' => $id]);
    
            // Libérer la disponibilité
            $stmt = $this->db->prepare("UPDATE disponibilite 
                SET est_reserve = FALSE 
                WHERE id_dentist = :dentist AND date_dispo = :date AND heure_dispo = :heure");
            $stmt->execute([
                'dentist' => $rdv['id_dentist'],
                'date' => $rdv['date_rdv'],
                'heure' => $rdv['heure_rdv']
            ]);
        }
    }
    



}
