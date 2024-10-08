<?php
namespace blog\views;
use navebar;
require_once "navebar.php";
    class UtilisateurView
    {
        public function __construct(){

        }

        public function afficher(){

            $navebar = new navebar();
            echo'<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/styles/reservation.css">
    <link rel="stylesheet" href="../../../assets/styles/footer.css">
    <link rel="stylesheet" href="../../../assets/styles/styles.css">
    <link rel="stylesheet" href="../../../assets/styles/navbar.css">
    <title>Réservation de Terrain</title>
</head>'.$navebar->afficher()."Salut salut !";
        }

    }
