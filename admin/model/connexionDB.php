<?php
namespace Admin\Model;

use PDO;
use PDOException;

class ConnexionDB {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $host = 'pedago.univ-avignon.fr';
                $port = '5432';
                $dbname = 'etd';
                $user = 'uapv2500230';
                $password = 'f23WdW';

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
