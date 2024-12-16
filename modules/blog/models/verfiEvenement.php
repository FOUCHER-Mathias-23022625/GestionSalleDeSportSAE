<?php

namespace blog\models;
use DateTime;
use PDO;
use PDOException;

require_once "www/GestionSalleDeSportSAE/modules/blog/models/bdModel.php";

class verfiEvenement
{

    private $evenementBD;

    public function __construct()
    {
        try {
            $this->evenementBD = new evenementModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function checkDate() {
        // Récupérer tous les événements avec leur date
        $requete = $this->evenementBD->pdo->prepare("SELECT idEven, DateEven FROM evenement");
        $requete->execute();
        $evenements = $requete->fetchAll(PDO::FETCH_ASSOC);

        // Vérifier chaque événement
        foreach ($evenements as $evenement) {
            $dateEvenement = new DateTime($evenement['DateEven']);
            $dateActuelle = new DateTime();

            // Si la date de l'événement est dépassée
            if ($dateEvenement <= $dateActuelle) {
                // Supprimer l'événement
                $requeteSuppression = $this->evenementBD->pdo->prepare("DELETE FROM evenement WHERE idEven = :idEven");
                $requeteSuppression->bindParam(':idEven', $evenement['idEven']);
                $requeteSuppression->execute();
            }
        }
    }

}

// Instanciation et appel des deux fonctions
$instance = new verfiEvenement();
$instance->checkDate();

?>