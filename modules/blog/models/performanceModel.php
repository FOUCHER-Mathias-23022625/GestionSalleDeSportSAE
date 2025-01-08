<?php
namespace blog\models;

use PDO;

class performanceModel {
    private $connexion;

    public function __construct() {
        try {
            $bd = new bdModel();
            $this->connexion = $bd->getConnexion();
        } catch (\PDOException $e) {
            // En cas d'erreur, afficher le message et arrêter l'exécution
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit; // Stoppe l'exécution en cas de problème de connexion
        }
    }

    public function getPerformances()
    {
        $id_user = $_SESSION['id'];
        $sql = "SELECT date, sport, temps_de_jeu, score, resultat FROM performances where id_user = $id_user order by date desc";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Retourne toutes les lignes sous forme de tableau associatif
    }

    public function insertPerformance($date, $sport, $tempsJeu, $score, $resultat)
    {
        $id_user = $_SESSION['id'];
        // Préparation de la requête SQL pour insérer les données dans la base
        $sql = "INSERT INTO performances (date, sport, temps_de_jeu, score, resultat, id_user)
            VALUES (:date, :sport, :temps_de_jeu, :score, :resultat, :id_user)";
        $sqlCheck = "SELECT COUNT(*) FROM performances WHERE date = :date and sport = :sport and id_user = :id_user";

        // Préparation de la vérification
        $stmtCheck = $this->connexion->prepare($sqlCheck);
        $stmtCheck->execute([
            ':date' => $date,
            ':sport' => $sport,
            ':id_user' => $id_user
        ]);
        //recupere le nombre d'entree existante
        $count = $stmtCheck->fetchColumn();

        if ($count>=1){
            $_SESSION['error_message'] = "Performance déjà existante, veuillez la supprimer et la réajouter pour la modifier.";
        }

        else{
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
    public function deletePerformance($date,$sport)
    {
        $id_user = $_SESSION['id'];
        // Préparer la requête pour supprimer la performance
        $sql = "DELETE FROM performances WHERE date = :date AND sport = :sport AND id_user = :id_user";
        $stmt = $this->connexion->prepare($sql);

        $stmt->execute([':date' => $date, ':sport' => $sport, ':id_user' => $id_user]);

    }

    public function getImc(): array
    {
        $id_user = $_SESSION['id'];
        $sql = "SELECT * FROM IMC where id_user = $id_user order by date desc ";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Retourne toutes les lignes sous forme de tableau associatif
    }

    public function insertImc($date, $poids, $taille)
    {
        $id_user = $_SESSION['id'];
        // Vérifie si une entrée pour cette date existe déjà
        $sql_check = "SELECT COUNT(*) FROM IMC WHERE date = :date and id_user = $id_user";
        $stmt_check = $this->connexion->prepare($sql_check);
        $stmt_check->execute([':date' => $date]);
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            // Si une entrée existe déjà, on met à jour les valeurs
            $sql_update = "UPDATE IMC SET poids = :poids, taille = :taille WHERE date = :date";
            $stmt_update = $this->connexion->prepare($sql_update);
            $stmt_update->execute([
                ':date' => $date,
                ':poids' => $poids,
                ':taille' => $taille,
            ]);
        } else {
            // Préparation de la requête SQL pour insérer les données dans la base
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

    /*public function estAbonne():bool
    {
        $id_user = $_SESSION['id'];
        // Préparer la requête
        $query = $this->connexionBD->pdo->prepare(
            "SELECT DateExp FROM abonnement WHERE idUtilisateur = :id_user AND DateExp IS NOT NULL AN DateExp > NOW()"
        );

        // Lier les paramètres et exécuter la requête
        $query->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();

        // Récupérer le résultat
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Si un résultat est retourné, alors l'utilisateur est abonné
        return $result !== false;    }*/
}
