<?php

namespace blog\models;

class evenementModel{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vérifier si l'utilisateur est déjà inscrit à un événement
    public function isUserSubscribed($idEvenement, $nom_utilisateur) {
        $query = $this->db->prepare("SELECT * FROM participation WHERE \"IdEvenement\" = :idEvenement AND \"nom_utilisateur\" = :nom_utilisateur");
        $query->execute([
            ':idEvenement' => $idEvenement,
            ':nom_utilisateur' => $nom_utilisateur
        ]);

        return $query->rowCount() > 0;
    }

    // Inscrire un utilisateur à un événement
    public function subscribeUser($idEvenement, $nom_utilisateur) {
        $insert = $this->db->prepare("INSERT INTO participation (\"IdEvenement\", \"nom_utilisateur\") VALUES (:idEvenement, :nom_utilisateur)");
        return $insert->execute([
            ':idEvenement' => $idEvenement,
            ':nom_utilisateur' => $nom_utilisateur
        ]);
    }

}
