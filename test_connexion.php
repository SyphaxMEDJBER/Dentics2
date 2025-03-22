<?php
try {
    $pdo = new PDO("pgsql:host=pedago.univ-avignon.fr;dbname=etd", "uapv2500230", "f23WdW");
    echo "Connexion réussie à la base de données PostgreSQL.";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
