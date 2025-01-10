<?php

namespace blog\tests;

use PHPUnit\Framework\TestCase;
use blog\models\reservationTerrainModel;
use blog\models\bdModel;
use PDO;
require_once __DIR__ . "/../models/reservationTerrainModel.php";


class testReservationTerrainModele extends TestCase
{
    private $pdo;
    private $reservationModel;

    // Configuration de la base de données avant chaque test
    protected function setUp(): void
    {
        // Connexion à la base de données de test
        $host = "mysql-gestionsaetest.alwaysdata.net";
        $username = "379076";
        $password = "gestionSae";
        $dbName = "gestionsaetest_testphp";

        $this->pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Création de la table si elle n'existe pas
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS reservationTerrain (
                sport VARCHAR(255) NOT NULL,
                date DATE NOT NULL,
                heure INT NOT NULL,
                terrain VARCHAR(255) NOT NULL,
                user_id INT NOT NULL
            )
        ");

        // Nettoyage des données avant chaque test
        $this->pdo->exec("DELETE FROM reservationTerrain");

        // Initialisation du modèle avec la connexion à la base de données
        $this->reservationModel = new reservationTerrainModel($this->pdo);
    }

    // Test pour vérifier la récupération des réservations avec des paramètres invalides
    public function testGetReservationTerrainInvalidParams()
    {
        // Tester avec des paramètres invalides
        $result = $this->reservationModel->getReservationTerrain('', '', '');
        $this->assertEmpty($result);
    }

    // Test pour vérifier l'insertion d'une réservation valide
    public function testInsererReservationSuccess()
    {
        // Tester une réservation valide
        $response = $this->reservationModel->insererReservation('tennis', '2025-01-15', 19, 1, 10054);

        $this->assertJson($response);
        $this->assertStringContainsString('success', $response);
    }

    // Test pour vérifier la limite de deux réservations par utilisateur pour une même journée
    public function testInsererReservationTooManyReservations()
    {
        // Ajouter deux réservations pour simuler la limite
        $this->pdo->exec("
            INSERT INTO reservationTerrain (sport, date, heure, terrain, user_id)
            VALUES ('tennis', '2025-01-10', '9', 1, 3),
                   ('basket', '2025-01-10', '10', 2, 3)
        ");

        // Tenter une troisième réservation
        $response = $this->reservationModel->insererReservation('volley', '2025-01-10', 11, 3, 3);

        $this->assertJson($response);
        $this->assertStringContainsString('error', $response);
    }

    // Test pour vérifier l'insertion d'une réservation avec un créneau horaire déjà réservé
    public function testInsererReservationTimeSlotConflict()
    {
        // Ajouter une réservation pour simuler un conflit
        $this->pdo->exec("
            INSERT INTO reservationTerrain (sport, date, heure, terrain, user_id) VALUES ('football', '2025-01-10', 10, 1, 4)");

        // Essayer de réserver à la même heure
        $response = $this->reservationModel->insererReservation('basket', '2025-01-10', 10, 1, 4);

        $this->assertJson($response);
        $this->assertStringContainsString('error', $response);
    }


}
