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
         $this->host = "localhost:3306";
         $this->username = "root";
         $this->mdp = "";
         $this->nomBD = "bdsae";
         $this->connectBD();
     }

     private function connectBD()
     {
         $this->pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->nomBD, $this->username, $this->mdp);
         return $this->pdo;
     }

     public function requete($sqlRequete){
         $resultat = $this->pdo->prepare($sqlRequete);
         return $resultat->execute();
     }


 }
?>

