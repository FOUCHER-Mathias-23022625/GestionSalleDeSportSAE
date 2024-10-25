<?php

namespace blog\views;

use blog\controllers\interfaceAdminController;

class interfaceAdminView
{
    public function afficher()
    {
        ob_start(); ?>
        <h1>Bienvenue sur la page admin</h1>

        <section>
            <h2>Utilisateurs</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
                <?php $afficherUtili = new interfaceAdminController();
                $afficherUtili->AfficheUsers(); ?>
            </table>
        </section>

        <section>
            <h2>Réservations</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Date</th>
                </tr>
                <?php $afficherUtili->AfficheReservations(); ?>
            </table>
        </section>

        <section>
            <h2>Événements</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Date</th>
                </tr>
                <?php $afficherUtili->AfficheEvenements();?>
            </table>
        </section>

    <?php (new \Blog\Views\Layout('Interface Administrateur', ob_get_clean()))->afficher();
    }
}