<?php

namespace blog\views;
use controllers\interfaceAdminController;
require_once "Layout.php";

class interfaceAdminView
{
    public function afficher()
    {
        ob_start(); ?>
        <main class="admin-container">
            <h1>Bienvenue sur la page admin</h1>

            <section>
                <h2>Utilisateurs</h2>
                <div class="search-filter-container">
                    <input type="text" id="search-utilisateurs" placeholder="Rechercher un utilisateur...">
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Actions</th>
                    </tr>
                    <?php $afficherUtili = new \controllers\interfaceAdminController();
                    $afficherUtili->AfficheUsers(); ?>
                </table>
            </section>

            <section>
                <h2>Réservations</h2>
                <div class="search-filter-container">
                    <input type="text" id="search-reservations" placeholder="Rechercher une réservation...">
                    <input type="text" id="filter-reservations" placeholder="Filtrer par sport...">
                </div>
                <table>
                    <tr>
                        <th>Sport</th>
                        <th>User ID</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Terrain</th>
                    </tr>
                    <?php $afficherResa = new \controllers\interfaceAdminController();
                    $afficherResa->AfficheReservations(); ?>
                </table>
            </section>

            <section>
                <h2>Événements</h2>
                <div class="search-filter-container">
                    <input type="text" id="search-evenements" placeholder="Rechercher un événement...">
                    <input type="text" id="filter-evenements" placeholder="Filtrer par sport...">
                </div>
                <table>
                    <tr>
                        <th>ID Événement</th>
                        <th>Nom de l'événement</th>
                        <th>Date</th>
                        <th>Sport</th>
                    </tr>
                    <?php $afficherEVE = new \controllers\interfaceAdminController();
                    $afficherEVE->AfficheEvenements(); ?>
                </table>
            </section>
        </main>

    <?php (new \Blog\Views\Layout('Interface Administrateur', ob_get_clean()))->afficher();
    }
}