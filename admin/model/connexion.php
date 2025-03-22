<?php
namespace Admin\Model;

use PDO;
use PDOException;

class Connexion {
    private static ?PDO $connexion = null;

    public static function getConnexion(): PDO {
        if (self::$connexion === null) {
            try {
                $host = 'pedago.univ-avignon.fr';
                $dbname = 'etd';
                $user = 'uapv2500230';
                $password = 'f23WdW';

                self::$connexion = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$connexion;
    }
}
