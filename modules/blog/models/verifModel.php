<?php

namespace blog\models;
use PDO;
use PDOException;

// Inclusion du modèle de base de données
require_once "www/GestionSalleDeSportSAE/modules/blog/models/bdModel.php";

class verifModel
{
    private $connexionBD;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct()
    {
        try {
            $this->connexionBD = new bdModel(); // Connexion via bdModel
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Fonction pour vérifier les abonnements expirant dans un mois
    public function requeteMois()
    {
        // Prépare une requête pour récupérer les utilisateurs dont l'abonnement expire dans un mois
        $requete = $this->connexionBD->pdo->prepare("
            SELECT idUtilisateur 
            FROM abonnement 
            WHERE dateExp = DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
        ");
        $requete->execute(); // Exécute la requête
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats

        if (!empty($donnees)) {
            // Parcourt les utilisateurs trouvés
            foreach ($donnees as $id) {
                // Récupère l'email de l'utilisateur
                $requete2 = $this->connexionBD->pdo->prepare("
                    SELECT EMail 
                    FROM utilisateur 
                    WHERE idUtilisateur = :idUtil
                ");
                $requete2->bindParam(":idUtil", $id["idUtilisateur"]);
                $requete2->execute();
                $donnees2 = $requete2->fetchAll(PDO::FETCH_ASSOC);

                // Envoie un email pour chaque utilisateur
                foreach ($donnees2 as $mail) {
                    mail($mail["EMail"], "Votre abonnement expire bientôt", "Bonjour, votre abonnement expire dans un mois !");
                }
            }
        } else {
            // Aucun abonnement n'expire dans un mois
            echo "Aucun abonnement expirant dans moins d'un mois.";
        }
    }

    // Fonction pour vérifier les abonnements expirant dans une semaine
    public function requeteSemaine()
    {
        // Prépare une requête pour récupérer les utilisateurs dont l'abonnement expire dans une semaine
        $requete = $this->connexionBD->pdo->prepare("
            SELECT idUtilisateur 
            FROM abonnement 
            WHERE dateExp = DATE_ADD(CURDATE(), INTERVAL 1 WEEK)
        ");
        $requete->execute(); // Exécute la requête
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats

        if (!empty($donnees)) {
            // Parcourt les utilisateurs trouvés
            foreach ($donnees as $id) {
                // Récupère l'email de l'utilisateur
                $requete2 = $this->connexionBD->pdo->prepare("
                    SELECT EMail 
                    FROM utilisateur 
                    WHERE idUtilisateur = :idUtil
                ");
                $requete2->bindParam(":idUtil", $id["idUtilisateur"]);
                $requete2->execute();
                $donnees2 = $requete2->fetchAll(PDO::FETCH_ASSOC);

                // Envoie un email pour chaque utilisateur
                foreach ($donnees2 as $mail) {
                    mail($mail["EMail"], "Votre abonnement expire bientôt", "Bonjour, votre abonnement expire dans une semaine !");
                }
            }
        } else {
            // Aucun abonnement n'expire dans une semaine
            echo "Aucun abonnement expirant dans moins d'un mois.";
        }
    }
}

// Instanciation de la classe et appel des méthodes
$instance = new verifModel();
$instance->requeteMois(); // Vérifie les abonnements pour le mois
$instance->requeteSemaine(); // Vérifie les abonnements pour la semaine

?>
