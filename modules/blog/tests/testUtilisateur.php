<?php

namespace blog\tests;


use PHPUnit\Framework\TestCase;
use blog\models\utilisateurModel;
use blog\models\bdModel;
require_once __DIR__ . "/../models/utilisateurModel.php";
require_once __DIR__ . "/../models/bdModel.php";


class testUtilisateur extends TestCase
{
    public function testVerifEmail()
    {
        $model = new utilisateurModel();
        $this->assertTrue($model->utilisateurMail('tom.om.barbero@gmail.com'));
    }

    public function testajouteUtilisateur(){
        $model = new utilisateurModel();
        $this->assertTrue($model->ajouteUtilisateur("testPhpUnitMail@gmail.com", 'mdp','prenom','nom'));
    }

    public function testdelete_utilisateur(){
        $model = new utilisateurModel();
        $this->assertTrue($model->delete_utilisateur(81));
    }

    public function testMailUtilisateur(){
        $model = new utilisateurModel();
        $this->assertTrue($model->utilisateurMail("tom.om.barbero@gmail.com"));

}
}
