<?php
namespace controllers;
use blog\models\abonnementModel;
use blog\models\performanceModel;
use blog\views\performanceView;
use index;

require_once "./index.php";
require_once "modules/blog/models/performanceModel.php";
require_once "modules/blog/views/performanceView.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class performanceController
{
    private $model;
    private $view;
    private $abonnementController;

    public function __construct()
    {
        $this->model = new performanceModel();
        $this->view = new performanceView();
        $this->abonnementController = new abonnementController();
    }

    // Affiche un tableau de performances s'il y en a, retourne `false` sinon
    public function afficherTableauPerformances($performances): bool
    {
        if (empty($performances)) {
            return false;
        }
        return true;
    }

    // Affiche les performances du modèle
    public function affichePerf()
    {
        $model = new performanceModel('mysql-gestionsaetest.alwaysdata.net', '379076', 'gestionSae', 'gestionsaetest_bd');
        $view = new performanceView();
        if(!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
        }
        $view->afficher($model->getPerformances(),$model->getImc());
    }

    // Retourne une liste de sports uniques pratiqués
    public function afficheSport($performances): string
    {
        if (!empty($performances)) {
            $sports = [];
            foreach ($performances as $performance) {
                $sport = htmlspecialchars($performance['sport']);
                if (!in_array($sport, $sports)) {
                    $sports[] = $sport;
                }
            }
            $html = implode(', ', $sports);
        } else {
            $html = '<p>Aucun sport pratiqué.</p>';
        }
        return $html;
    }

    // Calcule et retourne le temps total de jeu en heures et minutes
    function afficheTmps($performances): string
    {
        $tempsTotal = 0;
        if (!empty($performances)) {
            foreach ($performances as $performance) {
                $tempsTotal += (int)$performance['temps_de_jeu'];
            }
        }
        $heures = floor($tempsTotal / 60);
        $minutes = $tempsTotal % 60;
        $resultat = $heures . ' heure' . ($heures > 1 ? 's' : '') . ' et ' . $minutes . ' minute' . ($minutes > 1 ? 's' : '');
        return $resultat;
    }

    // Calcule et retourne le total des victoires
    function afficheTotVictoire($performances): int
    {
        $totalVictoire = 0;
        if (!empty($performances)) {
            foreach ($performances as $performance) {
                if ($performance['resultat'] == 1) {
                    $totalVictoire += 1;
                }
            }
        }
        return $totalVictoire;
    }

    // Renvoie les performances au format JSON
    public function getPerformanceJson()
    {
        $model = new performanceModel('host_name', 'user_name', 'password', 'database_name');
        $performances = $model->getPerformances();

        header('Content-Type: application/json');
        echo json_encode($performances);
    }

    // Renvoie les données IMC au format JSON
    public function getImcJson()
    {
        $model = new performanceModel('host_name', 'user_name', 'password', 'database_name');
        $imc = $model->getImc();

        header('Content-Type: application/json');
        echo json_encode($imc);
    }

    // Prépare les données des performances pour un graphique
    public function getPerformanceDataForGraph(): array
    {
        $performances = $this->model->getPerformances();

        $dates = [];
        $tempsjeu = [];

        foreach ($performances as $performance) {
            $dates[] = $performance['date'];
            $tempsjeu[] = (int)$performance['temps_de_jeu'];
        }

        return [
            'dates' => $dates,
            'temps_de_jeu' => $tempsjeu
        ];
    }

    // Prépare les données IMC pour un graphique
    public function getPerformanceDataForGraphImc(): array
    {
        $imcData = $this->model->getImc();
        $imc = [];
        $date = [];

        foreach ($imcData as $Imc) {
            $imc[] = $Imc['poids'] / (($Imc['taille'] / 100) * ($Imc['taille'] / 100));
            $date[] = $Imc['date'];
        }

        return [
            'date' => $date,
            'imc' => $imc
        ];
    }

    // Ajoute une performance à la base de données
    public function addPerformance()
    {
        $date = $_POST['Date'];
        $sport = $_POST['Sport'];
        $tempsJeu = $_POST['TempsJeu'];
        $score = $_POST['Score'];
        $resultat = ($_POST['resultat'] === 'Victoire') ? 1 : (($_POST['resultat'] === 'Égalité') ? 2 : 0);

        $currentDate = date('Y-m-d');

        if ($date > $currentDate) {
            $_SESSION['error_message'] = "La date de la performance ne peut pas être supérieure à la date du jour.";
            header('Location:affichePerf');
            exit();
        }
        if ($tempsJeu <= 0) {
            $_SESSION['error_message'] = "Le temps de jeu n'est pas valide.";
            header('Location:affichePerf');
            exit();
        }
        if (!$this->abonnementController->checkAbo()) {
            $_SESSION['error_message'] = "Vous devez souscrire à un abonnement pour ajouter une performance.";
            header('Location: affichePerf');
            exit();
        }
        $id_user = $_SESSION['id'];
        if ($date && $sport && $tempsJeu && $score && $resultat !== null && $id_user) {
            $this->model->insertPerformance($date, $sport, $tempsJeu, $score, $resultat);
            header('Location:affichePerf');
            exit();
        } else {
            echo "Veuillez remplir tous les champs obligatoires.";
        }
    }

    // Supprime une performance de la base de données
    public function deletePerformance()
    {
        var_dump($_POST);
        var_dump($_SESSION);
        $date = $_POST['Date'];
        $sport = $_POST['Sport'];
        $id_user = $_SESSION['id'];
        if ($date && $sport && $id_user) {
            $this->model->deletePerformance($date, $sport);
            header('Location: affichePerf');
            $_SESSION['valid_message'] = "Suppression de la performance réalisée avec succès.";
            exit();
        } else {
            $_SESSION['error_message'] = "Erreur avec les clés.";
            echo "Clés invalides pour la suppression.";
        }
    }

    // Ajoute un IMC à la base de données
    public function addImc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $poids = $_POST['poids'];
            $taille = $_POST['taille'];
            $date_du_j = date('Y-m-d');
            $id_user = $_SESSION['id'];

            if (!$this->abonnementController->checkAbo()) {
                $_SESSION['error_message'] = "Vous devez souscrire à un abonnement pour ajouter un indice de masse corporelle.";
                header('Location: affichePerf');
                exit();
            }
            if ($poids <= 0 || $taille <= 0) {
                $_SESSION['error_message'] = "Le poids et la taille doivent être des valeurs positives et non nulles.";
                header('Location:affichePerf');
                exit();
            } else {
                $this->model->insertImc($date_du_j, $poids, $taille);
                header('Location:affichePerf');
                exit();
            }
        }
    }

    // Affiche l'IMC du jour avec une interprétation
    public function afficheImc(): string
    {
        $imc = $this->model->getImc();

        $dateDuJour = date('Y-m-d');
        $imcDuJour = null;

        foreach ($imc as $IMC) {
            if (isset($IMC['date']) && $IMC['date'] == $dateDuJour) {
                $imcDuJour = $IMC;
                break;
            }
        }

        $html = '';
        if (!empty($imcDuJour)) {
            $imc = $imcDuJour['poids'] / (($imcDuJour['taille'] / 100) * ($imcDuJour['taille'] / 100));
            $imc = round($imc, 3);
            $html = "<h3>Votre IMC aujourd'hui est de : {$imc}</h3>";

            if ($imc < 18.5) {
                $html .= "<p class='sous-poids'>Vous êtes en sous-poids.</p>";
            } elseif ($imc >= 18.5 && $imc < 25) {
                $html .= "<p class='normal-poids'>Votre poids est normal.</p>";
            } elseif ($imc >= 25 && $imc < 30) {
                $html .= "<p class='sur-poids'>Vous êtes en surpoids.</p>";
            } else {
                $html .= "<p class='obesite'>Vous êtes en obésité.</p>";
            }
            $addImc = "Modifier mon IMC";
        } else {
            $html .= "<p>Calculez votre IMC.</p>";
            $addImc = "Ajouter mon IMC";
        }

        $html .= "<div class='button-containerPerf'>
                <button id='add-performance-btnPerf' onclick='formAjtImc()'>{$addImc}</button>
              </div>";

        return $html;
    }

    // Affiche l'historique des IMC
    public function afficheHistorique(): string
    {
        $IMC_data = $this->model->getImc();

        $html = "<button id='historique-btn' onclick='afficheHistorique()'>Historique</button>";
        $html .= "<table id='historique-table' style='display: none;'>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Taille (cm)</th>
                        <th>Poids (kg)</th>
                        <th>IMC</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($IMC_data as $IMC) {
            $imc = $IMC['poids'] / (($IMC['taille'] / 100) * ($IMC['taille'] / 100));
            $imc = round($imc, 2);
            $html .= "<tr>
                    <td>{$IMC['date']}</td>
                    <td>{$IMC['taille']}</td>
                    <td>{$IMC['poids']}</td>
                    <td>{$imc}</td>
                  </tr>";
        }

        $html .= "</tbody></table>";
        return $html;
    }
}
