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

    public function getDentistByEmail(string $email): ?Utilisateur {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email AND role = 'dentist'");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Utilisateur(
                $row['id'],
                $row['nom'],
                $row['email'],
                $row['mot_de_passe'],
                $row['role']
            );
        }

        return null;
    }

    public function getByEmail(string $email): ?Utilisateur {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Utilisateur(
                $row['id'],
                $row['nom'],
                $row['email'],
                $row['mot_de_passe'],
                $row['role']
            );
        }

        return null;
    }

    public function emailExiste(string $email): bool {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM utilisateur WHERE LOWER(email) = LOWER(?)");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function ajouterDentiste(string $nom, string $email, string $mdp): void {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES (?, ?, ?, 'dentist')");
        $stmt->execute([$nom, $email, $hash]);
        
        $id_utilisateur = $this->db->lastInsertId();
        $stmt2 = $this->db->prepare("INSERT INTO dentist (id_utilisateur) VALUES (?)");
        $stmt2->execute([$id_utilisateur]);
    }

    public function supprimerClient(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM client WHERE id_utilisateur = :id");
        $stmt->execute(['id' => $id]);

        $stmt = $this->db->prepare("DELETE FROM utilisateur WHERE id = :id AND role = 'client'");
        $stmt->execute(['id' => $id]);
    }
}