<?php
namespace blog\models;

class performanceModel {
    private $connexion;

    public function __construct($host_name, $user_name, $password, $database_name) {
        $this->connexion = new \PDO("mysql:host=$host_name;dbname=$database_name", $user_name, $password);
    }

    public function getPerformances() {
        $sql = "SELECT date, sport, temps_de_jeu, score FROM performance";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Retourne toutes les lignes sous forme de tableau associatif
    }
}