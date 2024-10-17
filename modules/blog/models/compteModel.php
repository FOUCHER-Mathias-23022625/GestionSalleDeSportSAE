<?php
namespace blog\models;
    class compteModel{
        private $connexionBD;


        public function __construct(){
            $this->connexionBD=new bdModel();
        }
        public function edit_utilisateur($idUtilisateur,$nom,$prenom,$dateNaissance,$mdp){
            $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur set idUtilisateur = $idUtilisateur
            , nom = $nom,prenom = $prenom,dateNaissance = $dateNaissance,mdp = $mdp");
            $requete->execute();
        }
    }
