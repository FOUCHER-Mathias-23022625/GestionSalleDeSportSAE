<?php
namespace blog\models;
require_once  "modules/blog/models/bdModel.php";
    class utilisateurModel{
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

        public function ajouteUtilisateur($mail,$mdp){

            $requete = $this->connexionBD->pdo->prepare("INSERT INTO utilisateur (mail, mdp) VALUES (:mail, :mdp)");
            $hashedMdp = password_hash($mdp, PASSWORD_DEFAULT);
            $requete->bindParam(":mail", $mail);
            $requete->bindParam(":mdp", $hashedMdp);
            $requete->execute();
            $_SESSION['id'] = $mail;
        }


        public function add_utilisateur($nom,$prenom,$dateNaissance,$mdp){
            $requete = $this->connexionBD->pdo->prepare("INSERT INTO utilisateur VALUES (mail =:mail,nom =:nom,prenom =:prenom,dateNaissance =:dateNaissance,mdp =:mdp )");
            $requete->bindParam(":nom",$nom);
            $requete->bindParam(":prenom",$prenom);
            $requete->bindParam(":dateNaissance",$dateNaissance);
            $requete->bindParam(":mdp",$mdp);
            $requete->bindParam(":mail",$mail);
            $requete->execute();
        }


        public function delete_utilisateur($idUtilisateur){
            $requete = $this->connexionBD->pdo->prepare("DELETE FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
            $requete->bindParam(":idUtilisateur",$idUtilisateur);
            $requete->execute();
        }


        public function connexion($mail,$mdp)
        {

            $requeteConnexion = $this->connexionBD->pdo->prepare("SELECT * FROM utilisateur WHERE mail = :mail AND mdp = :mdp");
            $requeteConnexion->bindParam(':mail', $mail);
            $requeteConnexion->bindParam(':mdp', $mdp);

            if ($requeteConnexion->execute()) {
                $donnees = $requeteConnexion->fetch();
                $_SESSION['id'] = $donnees['mail'];
                header('Location:afficheFormConnexion/'.$_SESSION['id']);
            }
            else{
                header('Location:eee');
            }
        }

    }
    ?>