<?php
namespace Admin\Model;

require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/Disponibilite.php';

use PDO;

/**
 * Classe permettant la gestion des disponibilités en base de données.
 */
class DisponibiliteManager {
    private PDO $db;

    /**
     * Initialise la connexion à la base de données via ConnexionDB.
     */
    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }

    /**
     * Ajoute une nouvelle disponibilité dans la base de données.
     *
     * @param \Admin\Model\Disponibilite $dispo Objet disponibilité à insérer
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
     * Récupère toutes les disponibilités présentes en base, triées par date et heure.
     *
     * @return Disponibilite[] Liste des objets Disponibilite
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
     * Supprime une disponibilité si elle n’est pas réservée.
     *
     * @param int $id ID de la disponibilité à supprimer
     * @return void
     */
    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM disponibilite WHERE id_dispo = :id AND est_reserve = FALSE");
        $stmt->execute([':id' => $id]);
    }
}
