<?php
namespace modules\blog\models;
    class UtilisateurModel{
        private $connexionBD;
        public function __construct(){
            $this->connexionBD=new bdModel();
        }
        public function utilisateurInformation($idUtilisateur){
            return $this->connexionBD->pdo->prepare("SELECT * FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
        }
        public function editUtilisateur($idUtilisateur,$nom,$prenom,$dateNaissance,$mdp){
            $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur set idUtilisateur = $idUtilisateur
            , nom = $nom,prenom = $prenom,dateNaissance = $dateNaissance,mdp = $mdp");
            $requete->execute();
        }
        public function connexion()
        {   if(isset($_POST[connexionButton])){
            $mail =$_POST["mail"];
            $mdp =$_POST["mdp"];
        }
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