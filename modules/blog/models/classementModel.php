<?php
namespace blog\models;

use PDO;

class classementModel {
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
    public function getClassement()
    {
        $sql = "SELECT 
                    utilisateur.IdUtilisateur, 
                    utilisateur.NomU,
                    utilisateur.PrenomU,
                    COUNT(performances.resultat) AS nombre_victoires
                FROM 
                    utilisateur
                LEFT JOIN 
                    performances
                ON 
                    utilisateur.IdUtilisateur = performances.id_user
                WHERE 
                    performances.resultat = 1 -- 1 signifie une victoire
                GROUP BY 
                    utilisateur.IdUtilisateur, utilisateur.NomU, utilisateur.PrenomU
                ORDER BY 
                    nombre_victoires DESC;
";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Retourne toutes les lignes sous forme de tableau associatif
    }

}
