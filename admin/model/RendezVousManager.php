<?php
namespace Admin\Model;

require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/RendezVous.php';

use PDO;

/**
 * Classe permettant la gestion des rendez-vous dans la base de données.
 */
class RendezVousManager {
    private PDO $db;

    /**
     * Initialise la connexion à la base de données.
     */
    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }

    /**
     * Récupère tous les rendez-vous triés par date et heure décroissantes.
     *
     * @return RendezVous[] Liste des rendez-vous
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

    /**
     * Confirme un rendez-vous en changeant son statut et en marquant la disponibilité associée comme réservée.
     *
     * @param int $id L'identifiant du rendez-vous à confirmer
     * @return void
     */
    public function confirmerRendezVous(int $id): void {
        $stmt = $this->db->prepare("SELECT id_dentist, date_rdv, heure_rdv FROM rendezvous WHERE id_rdv = :id");
        $stmt->execute(['id' => $id]);
        $rdv = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rdv) {
            $stmt = $this->db->prepare("UPDATE rendezvous SET statut = 'confirmé' WHERE id_rdv = :id");
            $stmt->execute(['id' => $id]);

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

    /**
     * Annule un rendez-vous en le supprimant et en libérant la disponibilité associée.
     *
     * @param int $id L'identifiant du rendez-vous à annuler
     * @return void
     */
    public function annulerRendezVous(int $id): void {
        $stmt = $this->db->prepare("SELECT id_dentist, date_rdv, heure_rdv FROM rendezvous WHERE id_rdv = :id");
        $stmt->execute(['id' => $id]);
        $rdv = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rdv) {
            $stmt = $this->db->prepare("DELETE FROM rendezvous WHERE id_rdv = :id");
            $stmt->execute(['id' => $id]);

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
