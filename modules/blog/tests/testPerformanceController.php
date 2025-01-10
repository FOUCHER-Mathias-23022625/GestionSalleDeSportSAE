<?php
namespace blog\tests;
use PHPUnit\Framework\TestCase;
use controllers\performanceController;
use blog\models\utilisateurModel;
use blog\models\bdModel;
require_once __DIR__ . "/../controllers/performanceController.php";
require_once __DIR__ . "/../views/performanceView.php";
require_once __DIR__ . "/../models/performanceModel.php";
require_once __DIR__ . "/../models/bdModel.php";
require_once __DIR__ . "/../controllers/abonnementController.php";

class testPerformanceController extends TestCase
{
    public function testAfficherTableauPerformancesReturnsFalseForEmptyPerformances()
    {
        $controller = new performanceController();
        $result = $controller->afficherTableauPerformances([]);
        $this->assertFalse($result);
    }

    public function testAfficherTableauPerformancesReturnsTrueForNonEmptyPerformances()
    {
        $controller = new performanceController();
        $performances = [['sport' => 'Football']];
        $result = $controller->afficherTableauPerformances($performances);
        $this->assertTrue($result);
    }
}
