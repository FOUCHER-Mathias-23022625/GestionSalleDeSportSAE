<?php
namespace blog\models;
    class UtilisateurModel{
        private $connexionBD;


        public function __construct(){
            $this->connexionBD=new bdModel();
        }
        

        public function utilisateurInformation($idUtilisateur){
            return $this->connexionBD->pdo->prepare("SELECT * FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
        }


        public function edit_utilisateur($idUtilisateur,$nom,$prenom,$dateNaissance,$mdp){
            $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur set idUtilisateur = $idUtilisateur
            , nom = $nom,prenom = $prenom,dateNaissance = $dateNaissance,mdp = $mdp");
            $requete->execute();
        }


        public function add_utilisateur($nom,$prenom,$dateNaissance,$mdp){
            $requete = $this->connexionBD->pdo->prepare("INSERT INTO utilisateur VALUES (nom =:nom,prenom =:prenom,dateNaissance =:dateNaissance,mdp =:mdp )");
            $requete->bindParam(":nom",$nom);
            $requete->bindParam(":prenom",$prenom);
            $requete->bindParam(":dateNaissance",$dateNaissance);
            $requete->bindParam(":mdp",$mdp);
            $requete->execute();
        }


        public function delete_utilisateur($idUtilisateur){
            $requete = $this->connexionBD->pdo->prepare("DELETE FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
            $requete->bindParam(":idUtilisateur",$idUtilisateur);
            $requete->execute();
        }


        public function connexion()
        {
            $mail =$_POST["mail"];
            $mdp =$_POST["mdp"];

            $requeteConnexion = $this->connexionBD->pdo->prepare("SELECT * FROM utilisateur WHERE mail = :mail AND mdp = :mdp");
            $requeteConnexion->bindParam(':mail', $mail);
            $requeteConnexion->bindParam(':mdp', $mdp);

            if ($requeteConnexion->execute()) {
                session_start();
                $donnees = $requeteConnexion->fetch();
                $_SESSION['id'] = $donnees['idUtilisateur'];
                header('Location:index.php');
            }
        }

    }
    ?>