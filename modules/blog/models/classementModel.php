<?php
namespace blog\models;

use PDO;

class classementModel {
    private $connexion;

    // Connexion à la base de données
    public function __construct() {
        try {
            $bd = new bdModel();
            $this->connexion = $bd->getConnexion();
        } catch (\PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            exit;
        }
    }

    // Classement par victoires
    public function getClassementVictoires()
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
                    performances.resultat = 1
                GROUP BY 
                    utilisateur.IdUtilisateur, utilisateur.NomU, utilisateur.PrenomU
                ORDER BY 
                    nombre_victoires DESC;
        ";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Formatage des noms et prénoms
        foreach ($result as &$row) {
            $row['NomU'] = mb_convert_case($row['NomU'], MB_CASE_TITLE, "UTF-8");
            $row['PrenomU'] = mb_convert_case($row['PrenomU'], MB_CASE_TITLE, "UTF-8");
        }

        return $result;
    }

    // Classement par nombre de performances
    public function getClassementPerformances()
    {
        $sql = "SELECT 
                    utilisateur.IdUtilisateur, 
                    utilisateur.NomU,
                    utilisateur.PrenomU,
                    COUNT(*) AS nombre_performances
                FROM 
                    utilisateur
                LEFT JOIN 
                    performances
                ON 
                    utilisateur.IdUtilisateur = performances.id_user
                WHERE 
                    performances.temps_de_jeu IS NOT NULL
                GROUP BY 
                    utilisateur.IdUtilisateur, utilisateur.NomU, utilisateur.PrenomU
                ORDER BY 
                    nombre_performances DESC;
        ";
        $stmt2 = $this->connexion->prepare($sql);
        $stmt2->execute();
        $result = $stmt2->fetchAll(\PDO::FETCH_ASSOC);

        // Formatage des noms et prénoms
        foreach ($result as &$row) {
            $row['NomU'] = mb_convert_case($row['NomU'], MB_CASE_TITLE, "UTF-8");
            $row['PrenomU'] = mb_convert_case($row['PrenomU'], MB_CASE_TITLE, "UTF-8");
        }

        return $result;
    }

    // Classement par temps cumulé
    public function getClassementTemps()
    {
        $sql = "SELECT 
                    utilisateur.IdUtilisateur, 
                    utilisateur.NomU,
                    utilisateur.PrenomU,
                    CONCAT(FLOOR(SUM(temps_de_jeu) / 60), 'h', 
                    LPAD(SUM(temps_de_jeu) % 60, 2, '0'), 'm') AS temps_cumule
                FROM 
                    utilisateur
                LEFT JOIN 
                    performances
                ON 
                    utilisateur.IdUtilisateur = performances.id_user
                WHERE 
                    performances.temps_de_jeu IS NOT NULL
                GROUP BY 
                    utilisateur.IdUtilisateur, utilisateur.NomU, utilisateur.PrenomU
                ORDER BY 
                    SUM(temps_de_jeu) DESC;
        ";
        $stmt3 = $this->connexion->prepare($sql);
        $stmt3->execute();
        $result = $stmt3->fetchAll(\PDO::FETCH_ASSOC);

        // Formatage des noms et prénoms
        foreach ($result as &$row) {
            $row['NomU'] = mb_convert_case($row['NomU'], MB_CASE_TITLE, "UTF-8");
            $row['PrenomU'] = mb_convert_case($row['PrenomU'], MB_CASE_TITLE, "UTF-8");
        }

        return $result;
    }
}
