<?php

namespace blog\controllers;

use blog\views\interfaceAdminView;

class interfaceAdminController
{
    private $interfaceAdminModel;

    public function __construct() {
        $this->interfaceAdminModel = new interfaceAdminModel();
    }

    public function afficherInterfaceAdmin() {
        $view = new interfaceAdminView();
        $view->afficher();
    }
    public function AfficheUsers()
    {
        $users = $this->interfaceAdminModel->GetAllUsers();
        foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                    </tr>
                <?php endforeach;
    }

    public function AfficheReservations()
    {
        $reservations = $this->interfaceAdminModel->GetAllReservations();
        foreach ($reservations as $reservation): ?>
        <tr>
            <td><?= htmlspecialchars($reservation['id']) ?></td>
            <td><?= htmlspecialchars($reservation['user_id']) ?></td>
            <td><?= htmlspecialchars($reservation['date']) ?></td>
        </tr>
        <?php endforeach;
    }

    public function AfficheEvenements()
    {
        $users = $this->interfaceAdminModel->GetAllEvenements();
        foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
            </tr>
        <?php endforeach;
    }
}