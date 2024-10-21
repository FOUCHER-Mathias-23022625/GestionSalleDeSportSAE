<?php

namespace blog\models;
use PDO;
 class bdModel
 {
     private $estConnecte;
     private $host;
     private $username;
     private $mdp;
     private $nomBD;
     public PDO $pdo;


     public function __construct()
     {
         $this->host= "mysql-gestionsaetest.alwaysdata.net";
         $this->username = "379076";
         $this->mdp  = "gestionSae";
         $this->nomBD = "gestionsaetest_bd";
         $this->connectBD($this->host, $this->username, $this->mdp, $this->nomBD);

     }

     private function connectBD($host, $username, $mdp, $nomBD)
     {

         $this->pdo = new PDO("mysql:host=$host;dbname=$nomBD", $username, $mdp);
         return $this->pdo;
     }

     public function requete($sqlRequete){
         $resultat = $this->pdo->prepare($sqlRequete);
         return $resultat->execute();
     }


 }
?>

