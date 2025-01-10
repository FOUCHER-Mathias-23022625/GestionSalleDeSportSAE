<?php
namespace blog\models;

use PDO;

class performanceModel {
    private $connexion;

    public function __construct() {
        try {
            $bd = new bdModel();  // Instanciation d'une classe bdModel pour la connexion à la base
            $this->connexion = $bd->getConnexion();  // Obtenir la connexion PDO à la base de données
        } catch (\PDOException $e) {
            // En cas d'erreur, afficher le message et arrêter l'exécution
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit; // Arrête l'exécution si une erreur de connexion se produit
        }
    }

    // Fonction pour récupérer toutes les performances d'un utilisateur
    public function getPerformances() {
        $id_user = $_SESSION['id'];  // L'identifiant de l'utilisateur est stocké dans la session
        $sql = "SELECT date, sport, temps_de_jeu, score, resultat FROM performances WHERE id_user = $id_user ORDER BY date DESC";
        $stmt = $this->connexion->prepare($sql);  // Préparer la requête
        $stmt->execute();  // Exécuter la requête
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Retourne les résultats sous forme de tableau associatif
    }

    // Fonction pour insérer une nouvelle performance
    public function insertPerformance($date, $sport, $tempsJeu, $score, $resultat) {
        $id_user = $_SESSION['id'];
        $sqlCheck = "SELECT COUNT(*) FROM performances WHERE date = :date AND sport = :sport AND id_user = :id_user";

        // Préparation de la vérification si la performance existe déjà
        $stmtCheck = $this->connexion->prepare($sqlCheck);
        $stmtCheck->execute([
            ':date' => $date,
            ':sport' => $sport,
            ':id_user' => $id_user
        ]);
        $count = $stmtCheck->fetchColumn();  // Compte le nombre d'entrées avec ces critères

        if ($count >= 1) {
            // Si la performance existe déjà, afficher un message d'erreur
            $_SESSION['error_message'] = "Performance déjà existante, veuillez la supprimer et la réajouter pour la modifier.";
        } else {
            $sql = "INSERT INTO performances (date, sport, temps_de_jeu, score, resultat, id_user) 
                    VALUES (:date, :sport, :temps_de_jeu, :score, :resultat, :id_user)";

            $stmt = $this->connexion->prepare($sql);
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

    // Fonction pour supprimer une performance
    public function deletePerformance($date, $sport) {
        $id_user = $_SESSION['id'];
        $sql = "DELETE FROM performances WHERE date = :date AND sport = :sport AND id_user = :id_user";
        $stmt = $this->connexion->prepare($sql);

        $stmt->execute([':date' => $date, ':sport' => $sport, ':id_user' => $id_user]);
    }

    // Fonction pour récupérer l'IMC d'un utilisateur
    public function getImc(): array {
        $id_user = $_SESSION['id'];
        $sql = "SELECT * FROM IMC WHERE id_user = $id_user ORDER BY date DESC";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Retourne toutes les lignes sous forme de tableau associatif
    }

    // Fonction pour insérer ou mettre à jour l'IMC
    public function insertImc($date, $poids, $taille) {
        $id_user = $_SESSION['id'];

        // Vérification si une entrée IMC existe déjà pour cette date
        $sql_check = "SELECT COUNT(*) FROM IMC WHERE date = :date AND id_user = $id_user";
        $stmt_check = $this->connexion->prepare($sql_check);
        $stmt_check->execute([':date' => $date]);
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            // Si l'entrée existe, on met à jour les informations IMC
            $sql_update = "UPDATE IMC SET poids = :poids, taille = :taille WHERE date = :date";
            $stmt_update = $this->connexion->prepare($sql_update);
            $stmt_update->execute([
                ':date' => $date,
                ':poids' => $poids,
                ':taille' => $taille,
            ]);
        } else {
            // Préparation de la requête SQL pour insérer les données dans la table IMC
            $sql = "INSERT INTO IMC (date, poids, taille, id_user) VALUES (:date, :poids, :taille, :id_user)";
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
?>
