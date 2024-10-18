<?php

namespace blog\models;

class evenementModel{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vérifier si l'utilisateur est déjà inscrit à un événement
    public function isUserSubscribed($idEvenement, $idUtilisateur) {
        $query = $this->db->prepare("SELECT * FROM participation WHERE \"IdEvenement\" = :idEvenement AND \"IdUtilisateur\" = :idUtilisateur");
        $query->execute([
            ':idEvenement' => $idEvenement,
            ':idUtilisateur' => $idUtilisateur
        ]);

        return $query->rowCount() > 0;
    }

    // Inscrire un utilisateur à un événement
    public function subscribeUser($idEvenement, $idUtilisateur) {
        $insert = $this->db->prepare("INSERT INTO participation (\"IdEvenement\", \"IdUtilisateur\") VALUES (:idEvenement, :idUtilisateur)");
        return $insert->execute([
            ':idEvenement' => $idEvenement,
            ':idUtilisateur' => $idUtilisateur
        ]);
    }

}