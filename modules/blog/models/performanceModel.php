<?php
namespace blog\models;

class performanceModel {
    private $connexion;

    public function __construct($host_name, $user_name, $password, $database_name) {
        try {
            // Tentative de connexion à la base de données
            $this->connexion = new \PDO("mysql:host=$host_name;dbname=$database_name", $user_name, $password);
            // Activer les exceptions PDO pour afficher les erreurs
            $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // En cas d'erreur, afficher le message et arrêter l'exécution
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit; // Stoppe l'exécution en cas de problème de connexion
        }
    }

    public function getPerformances() {
        $sql = "SELECT date, sport, temps_de_jeu, score, resultat FROM performances";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Retourne toutes les lignes sous forme de tableau associatif
    }

    public function insertPerformance($date, $sport, $tempsJeu, $score, $resultat): void
    {
        // Préparation de la requête SQL pour insérer les données dans la base
        $sql = "INSERT INTO performances (date, sport, temps_de_jeu, score, resultat)
            VALUES (:date, :sport, :temps_de_jeu, :score, :resultat)";

        $stmt = $this->connexion->prepare($sql);

        // Exécution de la requête avec les valeurs fournies
        $stmt->execute([
            ':date' => $date,
            ':sport' => $sport,
            ':temps_de_jeu' => $tempsJeu,
            ':score' => $score,
            ':resultat' => $resultat
        ]);
    }
    public function deletePerformance($date,$sport): void
    {
        // Préparer la requête pour supprimer la performance
        $sql = "DELETE FROM performances WHERE date = :date AND sport = :sport";
        $stmt = $this->connexion->prepare($sql);

        $stmt->execute([':date' => $date, ':sport' => $sport]);
    }
}
