<?php
namespace blog\tests;
use PHPUnit\Framework\TestCase;
use controllers\performanceController;

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
