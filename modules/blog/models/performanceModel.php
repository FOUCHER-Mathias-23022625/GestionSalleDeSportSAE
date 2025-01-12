<?php
namespace blog\models;

use PDO;

class performanceModel {
    private $connexion;

    public function __construct() {
        try {
            $bd = new bdModel(); // Instancie la classe bdModel pour se connecter à la base de données
            $this->connexion = $bd->getConnexion(); // Récupère la connexion PDO
        } catch (\PDOException $e) {
            // En cas d'erreur, affiche le message et arrête l'exécution
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit; // Arrête l'exécution
        }
    }

    // Récupère toutes les performances d'un utilisateur donné
    public function getPerformances()
    {
        $id_user = $_SESSION['id']; // Récupère l'ID de l'utilisateur depuis la session
        $sql = "SELECT date, sport, temps_de_jeu, score, resultat FROM performances WHERE id_user = $id_user ORDER BY date DESC";
        $stmt = $this->connexion->prepare($sql); // Prépare la requête SQL
        $stmt->execute(); // Exécute la requête
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Retourne toutes les performances sous forme de tableau associatif
    }

    // Insère une nouvelle performance dans la base de données
    public function insertPerformance($date, $sport, $tempsJeu, $score, $resultat)
    {
        $id_user = $_SESSION['id']; // Récupère l'ID de l'utilisateur depuis la session
        $sqlCheck = "SELECT COUNT(*) FROM performances WHERE date = :date AND sport = :sport AND id_user = :id_user";

        // Préparation de la vérification de l'existence de la performance
        $stmtCheck = $this->connexion->prepare($sqlCheck);
        $stmtCheck->execute([
            ':date' => $date,
            ':sport' => $sport,
            ':id_user' => $id_user
        ]);
        $count = $stmtCheck->fetchColumn(); // Récupère le nombre de performances existantes

        if ($count >= 1) {
            $_SESSION['error_message'] = "Performance déjà existante, veuillez la supprimer et la réajouter pour la modifier.";
        } else {
            // Préparation de la requête SQL pour insérer les données
            $sql = "INSERT INTO performances (date, sport, temps_de_jeu, score, resultat, id_user)
                VALUES (:date, :sport, :temps_de_jeu, :score, :resultat, :id_user)";
            $stmt = $this->connexion->prepare($sql);

            // Exécution de la requête avec les valeurs fournies
            $stmt->execute([
                ':date' => $date,
                ':sport' => $sport,
                ':temps_de_jeu' => $tempsJeu,
                ':score' => $score,
                ':resultat' => $resultat,
                ':id_user' => $id_user
            ]);
        }
    }

    // Supprime une performance spécifique basée sur la date et le sport
    public function deletePerformance($date, $sport)
    {
        $id_user = $_SESSION['id']; // Récupère l'ID de l'utilisateur depuis la session
        // Préparer la requête SQL pour supprimer la performance
        $sql = "DELETE FROM performances WHERE date = :date AND sport = :sport AND id_user = :id_user";
        $stmt = $this->connexion->prepare($sql);

        $stmt->execute([':date' => $date, ':sport' => $sport, ':id_user' => $id_user]); // Exécute la suppression
    }

    // Récupère toutes les données d'IMC d'un utilisateur
    public function getImc(): array
    {
        $id_user = $_SESSION['id']; // Récupère l'ID de l'utilisateur depuis la session
        $sql = "SELECT * FROM IMC WHERE id_user = $id_user ORDER BY date DESC";
        $stmt = $this->connexion->prepare($sql); // Prépare la requête SQL
        $stmt->execute(); // Exécute la requête
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Retourne toutes les données d'IMC sous forme de tableau associatif
    }

    // Insère un IMC dans la base de données. Met à jour si la date existe déjà.
    public function insertImc($date, $poids, $taille)
    {
        $id_user = $_SESSION['id']; // Récupère l'ID de l'utilisateur depuis la session
        $sql_check = "SELECT COUNT(*) FROM IMC WHERE date = :date AND id_user = $id_user";
        $stmt_check = $this->connexion->prepare($sql_check);
        $stmt_check->execute([':date' => $date]);
        $count = $stmt_check->fetchColumn(); // Récupère le nombre d'entrées pour cette date

        if ($count > 0) {
            // Si une entrée existe déjà pour cette date, on met à jour les données
            $sql_update = "UPDATE IMC SET poids = :poids, taille = :taille WHERE date = :date";
            $stmt_update = $this->connexion->prepare($sql_update);
            $stmt_update->execute([
                ':date' => $date,
                ':poids' => $poids,
                ':taille' => $taille,
            ]);
        } else {
            // Préparation de la requête SQL pour insérer les données d'IMC
            $sql = "INSERT INTO IMC (date, poids, taille, id_user)
            VALUES (:date, :poids, :taille, :id_user)";
            $stmt = $this->connexion->prepare($sql);

            // Exécution de la requête avec les valeurs fournies
            $stmt->execute([
                ':date' => $date,
                ':poids' => $poids,
                ':taille' => $taille,
                ':id_user' => $id_user
            ]);
        }
    }
}
