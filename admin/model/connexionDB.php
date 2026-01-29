<?php
namespace Admin\Model;

use PDO;
use PDOException;
/**
 * Summary of ConnexionDB
 */
class ConnexionDB {
    private static ?PDO $instance = null;
    /**
     * Summary of getInstance
     * @return PDO|null
     */
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $host = 'pedago01c.univ-avignon.fr';//01c
                $port = '5432';
                $dbname = 'etd';
                $user = 'caché pour rendre le depo public';
                $password = 'caché pour rendre le depo public ';
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                self::$instance = new PDO($dsn, $user, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
