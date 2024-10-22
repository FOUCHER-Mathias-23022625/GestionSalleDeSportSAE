<?php

namespace blog\models;

class evenementModel{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getEvenements() {
        $sql = "SELECT * FROM evenements";
        try {
            $result = $this->db->query($sql);
            if (!$result) {
                throw new \Exception("Erreur lors de l'exécution de la requête SQL");
            }
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }

    public function isUserSubscribed($idEvenement, $nom_utilisateur) {
        $query = $this->db->prepare("SELECT * FROM participation WHERE \"IdEvenement\" = :idEvenement AND \"nom_utilisateur\" = :nom_utilisateur");
        $query->execute([
            ':idEvenement' => $idEvenement,
            ':nom_utilisateur' => $nom_utilisateur
        ]);

        return $query->rowCount() > 0;
    }

    public function subscribeUser($idEvenement, $nom_utilisateur) {
        $insert = $this->db->prepare("INSERT INTO participation (\"IdEvenement\", \"nom_utilisateur\") VALUES (:idEvenement, :nom_utilisateur)");
        return $insert->execute([
            ':idEvenement' => $idEvenement,
            ':nom_utilisateur' => $nom_utilisateur
        ]);
    }

}
