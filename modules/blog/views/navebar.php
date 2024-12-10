<?php
session_start();

//use controllers\utilisateurController;

//require_once __DIR__ . '/../controllers/utilisateurController.php';

    class navebar
    {
        public function estConnecte(){
            if(isset($_SESSION['id'])){
                return true;
            }
            return false;
        }

        public function afficher(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            ?>
            <header>
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <div class="navbar-brand me-auto" onclick="window.location.href='/GestionSalleDeSportSAE/homepage/accueil';">
                            Sport
                            <span class="hub">Hub</span>
                        </div>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header">
                                <div class="offcanvas-title" id="offcanvasNavbarLabel" onclick="window.location.href='/GestionSalleDeSportSAE/homepage/accueil';">
                                    Sport
                                    <span class="hub">Hub</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                                    <li class="nav-item">
                                        <a class="nav-link mx-lg-2 active" aria-current="page" href="/GestionSalleDeSportSAE/homepage/accueil">Accueil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mx-lg-2" href="/GestionSalleDeSportSAE/reservationTerrain/displayReservationTerrain">Réservation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mx-lg-2" href="/GestionSalleDeSportSAE/evenement/afficheEvenement">Évenement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mx-lg-2" href="/GestionSalleDeSportSAE/performance/affichePerf">Performances</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mx-lg-2" href="/GestionSalleDeSportSAE/utilisateur/deconnecte">Deco</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php if($this->estConnecte()):
                            $model = new \blog\models\compteModel();
                            $image = $model->utilisateurInformation()['pp'];
                            if (!$image) {
                                $image = "pp.png";
                            }
                            ?>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/GestionSalleDeSportSAE/assets/images/public/<?= $image ?>" alt="Photo de Profil" class="photoProfil">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="/GestionSalleDeSportSAE/compte/afficheCompte">Service 1</a></li>
                                <li><a class="dropdown-item" href="/GestionSalleDeSportSAE/utilisateur/deconnecte">Déconnexion</a></li>
                                <li><a class="dropdown-item" href="/GestionSalleDeSportSAE/compte/afficheCompte">Service 3</a></li>
                            </ul>
                            <!--<li class="nav-item">
                                <a class="nav-link mx-lg-2" href="/GestionSalleDeSportSAE/utilisateur/deconnecte">Déconnexion</a>
                            </li> -->
                        <?php else: ?>
                            <a href="/GestionSalleDeSportSAE/utilisateur/afficheFormConnexion" class="login-button">Connexion</a>
                        <?php endif; ?>

                        <button class="navbar-toggler pe-8" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                            <span class="navbar-light navbar-toggler-icon"></span>
                        </button>
                    </div>
                </nav>
            </header>
        <?php
        }

    }

    ?>

