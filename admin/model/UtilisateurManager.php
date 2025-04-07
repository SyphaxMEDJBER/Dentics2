<?php
namespace Admin\Model;

require_once 'ConnexionDB.php';
require_once __DIR__ . '/../class/Utilisateur.php';

use PDO;

/**
 * Gère les opérations liées aux utilisateurs dans la base de données.
 */
class UtilisateurManager {
    private PDO $db;

    /**
     * Initialise la connexion à la base de données.
     */
    public function __construct() {
        $this->db = ConnexionDB::getInstance();
    }

    /**
     * Récupère tous les utilisateurs enregistrés.
     *
     * @return Utilisateur[] Liste des utilisateurs
     */
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

    /**
     * Récupère un utilisateur de type dentiste à partir de son email.
     *
     * @param string $email Email du dentiste
     * @return Utilisateur|null L'utilisateur trouvé ou null
     */
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

    /**
     * Récupère un utilisateur par son email, quel que soit son rôle.
     *
     * @param string $email Email de l'utilisateur
     * @return Utilisateur|null L'utilisateur trouvé ou null
     */
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

    /**
     * Vérifie si un email existe déjà dans la base (sans tenir compte de la casse).
     *
     * @param string $email Email à vérifier
     * @return bool Vrai si l'email existe, faux sinon
     */
    public function emailExiste(string $email): bool {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM utilisateur WHERE LOWER(email) = LOWER(?)");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Ajoute un nouvel utilisateur avec le rôle dentiste et un mot de passe hashé.
     *
     * @param string $nom Nom du dentiste
     * @param string $email Email du dentiste
     * @param string $mdp Mot de passe en clair
     * @return void
     */
    public function ajouterDentiste(string $nom, string $email, string $mdp): void {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES (?, ?, ?, 'dentist')");
        $stmt->execute([$nom, $email, $hash]);

        $id_utilisateur = $this->db->lastInsertId();
        $stmt2 = $this->db->prepare("INSERT INTO dentist (id_utilisateur) VALUES (?)");
        $stmt2->execute([$id_utilisateur]);
    }

    /**
     * Supprime un utilisateur de rôle client ainsi que son enregistrement dans la table `client`.
     *
     * @param int $id ID de l'utilisateur
     * @return void
     */
    public function supprimerClient(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM client WHERE id_utilisateur = :id");
        $stmt->execute(['id' => $id]);

        $stmt = $this->db->prepare("DELETE FROM utilisateur WHERE id = :id AND role = 'client'");
        $stmt->execute(['id' => $id]);
    }
}
