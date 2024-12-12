<?php
namespace controllers;
use blog\models\performanceModel;
use blog\views\performanceView;
require_once "modules/blog/views/performanceView.php";
require_once "modules/blog/models/performanceModel.php";
require_once "./index.php";



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class performanceController
{
    private $model;
    private $view;

    public function __construct()
    {

        $this->model = new performanceModel();
        $this->view = new performanceView();
    }
    public function afficherTableauPerformances($performances): bool
    {
        if (empty($performances)) {
            return false;
        }
        return true;
    }

    public function affichePerf()
    {
        $model = new performanceModel('mysql-gestionsaetest.alwaysdata.net', '379076', 'gestionSae', 'gestionsaetest_bd');
        $view = new performanceView();
        if(!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
        }
        $view->afficher($model->getPerformances(),$model->getImc());
    }

    public function afficheSport($performances): string
    {
        // Vérifie si des performances sont disponibles
        if (!empty($performances)) {
            $sports = [];
            foreach ($performances as $performance) {
                $sport = htmlspecialchars($performance['sport']);
                // Ajoute le sport s'il n'est pas déjà dans le tableau
                if (!in_array($sport, $sports)) {
                    $sports[] = $sport;
                }
            }
            // Génère une chaîne de sports séparée par des virgules
            $html = implode(', ', $sports);
        } else {
            // Si aucun sport pratiqué
            $html = '<p>Aucun sport pratiqué.</p>';
        }
        return $html; // Retourne le code HTML pour l'affichage dans la vue
    }

    function afficheTmps($performances): string
    {
        $tempsTotal = 0;
        // Vérifie si des performances sont disponibles
        if (!empty($performances)) {
            foreach ($performances as $performance) {
                // Additionne la durée en minutes pour chaque performance
                $tempsTotal += (int)$performance['temps_de_jeu'];
            }
        }
        // Convertit le temps total en heures et minutes
        $heures = floor($tempsTotal / 60);
        $minutes = $tempsTotal % 60;

        // Génère une chaîne pour afficher le temps sous forme "X heures et Y minutes"
        $resultat = $heures . ' heure' . ($heures > 1 ? 's' : '') .
            ' et ' . $minutes . ' minute' . ($minutes > 1 ? 's' : '');

        return $resultat;
    }

    function afficheTotVictoire($performances): int
    {
        $totalVictoire = 0;

        // Vérifie si des performances sont disponibles
        if (!empty($performances)) {
            foreach ($performances as $performance) {
                if ($performance['resultat']) {
                    $totalVictoire += 1;
                }
            }
        }
        return $totalVictoire;
    }

    public function getPerformanceJson() {
        $model = new performanceModel('host_name', 'user_name', 'password', 'database_name');
        $performances = $model->getPerformances();

        header('Content-Type: application/json');
        echo json_encode($performances);
    }

    public function getImcJson() {
        $model = new performanceModel('host_name', 'user_name', 'password', 'database_name');
        $imc = $model->getImc();

        header('Content-Type: application/json');
        echo json_encode($imc);
    }

    public function getPerformanceDataForGraph(): array
    {
        $performances = $this->model->getPerformances();

        $dates = [];
        $tempsjeu = [];

        foreach ($performances as $performance) {
            $dates[] = $performance['date'];
            $tempsjeu[] = (int)$performance['temps_de_jeu'];
        }

        // Retourner un tableau associatif avec les données nécessaires pour le graphe
        return [
            'dates' => $dates,
            'temps_de_jeu' => $tempsjeu
        ];
    }

    public function getPerformanceDataForGraphImc(): array
    {
        $imcData = $this->model->getImc();
        $imc = [];
        $date = [];

        foreach ($imcData as $Imc) {
            $imc[] = $Imc['poids'] / (($Imc['taille'] / 100) * ($Imc['taille'] / 100));
            $date[] = $Imc['date'];
        }

        // Retourner un tableau associatif avec les données nécessaires pour le graphe
        return [
            'date' => $date,
            'imc' => $imc
        ];
    }

    public function addPerformance()
    {
        // Récupère les données du formulaire

        $date = $_POST['Date'];
        $sport = $_POST['Sport'];
        $tempsJeu = $_POST['TempsJeu'];
        $score = $_POST['Score'];
        $resultat = ($_POST['resultat'] === 'Victoire') ? 1 : 0;

        // Récupérer la date du jour
        $currentDate = date('Y-m-d');

        // Vérifier si la date de la performance n'est pas supérieure à la date du jour
        if ($date > $currentDate) {
            $_SESSION['error_message'] = "La date de la performance ne peut pas être supérieure à la date du jour.";
            echo "La date de la performance ne peut pas être supérieure à la date du jour.";
            header('Location:affichePerf');
            exit();
        }
        if($tempsJeu <=0) {
            $_SESSION['error_message'] = "Le temps de jeu n'est pas valide.";
            echo "Le temps de jeu n'est pas valide.";
            header('Location:affichePerf');
            exit();
        }
        // Vérifie que toutes les données obligatoires sont présentes
        $id_user = $_SESSION['id'];
        if ($date && $sport && $tempsJeu && $score && $resultat !== null && $id_user) {
            // Ajouter la performance à la base de données
            $this->model->insertPerformance($date, $sport, $tempsJeu, $score, $resultat);
            header('Location:affichePerf');
            exit();
        }
        else {
            echo "Veuillez remplir tous les champs obligatoires.";
        }
    }

    public function deletePerformance()
    {
        var_dump($_POST); // Vérifiez que les données sont bien envoyées
        var_dump($_SESSION);
        $date = $_POST['Date'];
        $sport = $_POST['Sport'];
        $id_user = $_SESSION['id'];
        // Vérifie que la cle primaire est bien fourni
        if ($date && $sport && $id_user) {
            $this->model->deletePerformance($date, $sport);

            // Redirection après la suppression
            header('Location: affichePerf');
            $_SESSION['valid_message'] = "Suppression de la performance réalisé avec succès.";
            exit();
        } else {
            $_SESSION['error_message'] = "Erreur avec les clés.";
            echo "Clés invalides pour la suppression.";
        }
    }

    public function addImc()
    {
        // Vérifier que les données ont été envoyées via la méthode POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $poids = $_POST['poids'];
            $taille = $_POST['taille'];
            $date_du_j = date('Y-m-d');
            $id_user = $_SESSION['id']; // Assure que l'utilisateur est connecté

            // Vérifier que poids et taille sont positifs et différents de 0
            if ($poids <= 0 || $taille <= 0) {
                $_SESSION['error_message'] = "Le poids et la taille doivent être des valeurs positives et non nulles.";
                header('Location:affichePerf'); // Rediriger vers la page performances
                exit;
            }
            else{
                $this->model->insertImc($date_du_j, $poids, $taille);

                // Redirection après succès
                header('Location:affichePerf');
                exit;
            }

        }
    }

    public function afficheImc(): string
    {
        // Récupérer toutes les données d'IMC depuis le modèle

        $imc = $this->model->getImc();


        // Vérifie qu'il y a un IMC calculé pour aujourd'hui
        $dateDuJour = date('Y-m-d'); // Format AAAA-MM-JJ
        $imcDuJour = null;

        // Parcourir toutes les données pour trouver l'IMC du jour
        foreach ($imc as $IMC) {
            if (isset($IMC['date']) && $IMC['date'] == $dateDuJour) {
                $imcDuJour = $IMC;
                break; // On arrête la boucle dès qu'on trouve l'IMC du jour
            }
        }
        $html = '';
        // si un IMC du jour a été trouvé
        if (!empty($imcDuJour)) {
            // Calcul de l'IMC
            $imc = $imcDuJour['poids'] / (($imcDuJour['taille'] / 100) * ($imcDuJour['taille'] / 100));

            // Arrondir l'IMC
            $imc = round($imc, 3);

            // Générer le HTML pour afficher l'IMC
            $html = "<h3>Votre IMC aujourd'hui est de : {$imc}</h3>";

            // Ajouter une interprétation de l'IMC
            if ($imc < 18.5) {
                $html .= "<p class='sous-poids'>Vous êtes en sous-poids.</p>";
            } elseif ($imc >= 18.5 && $imc < 25) {
                $html .= "<p class='normal-poids'>Votre poids est normal.</p>";
            } elseif ($imc >= 25 && $imc < 30) {
                $html .= "<p class='sur-poids'>Vous êtes en surpoids.</p>";
            } else {
                $html .= "<p class='obesite'>Vous êtes en obésité.</p>";
            }
            // Si un IMC du jour existe, afficher le bouton Modifier mon IMC du jour
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

    public function afficheHistorique(): string
    {
        // Récupérer toutes les données d'IMC depuis le modèle, triées par date décroissante
        $IMC_data = $this->model->getImc();

        // Initialiser le HTML
        $html = "<button id='historique-btn' onclick='afficheHistorique()'>Historique</button>";

        // Générer le tableau HTML de l'historique
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

        // Parcourir les données pour générer les lignes du tableau
        foreach ($IMC_data as $IMC) {
            // Calcul de l'IMC pour chaque enregistrement
            $imc = $IMC['poids'] / (($IMC['taille'] / 100) * ($IMC['taille'] / 100));
            $imc = round($imc, 2);

            // Générer chaque ligne du tableau
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
