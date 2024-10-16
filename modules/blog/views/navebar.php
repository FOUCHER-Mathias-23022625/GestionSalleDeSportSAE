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
           // $deco = new utilisateurController();
            ?>
            <header>
            <div class="navBar">
                <a href="/GestionSalleDeSportSAE/homepage/displayHome" class="HeadTitle">Sport Hub</a>
                <nav class="menuNavBar">
                    <ul class="sidebar">
                        <li><a class="sidebarBtnA"><img src="/GestionSalleDeSportSAE/assets/images/croix-blanche.png" alt="bouton menu burger"  onclick="hideSidebar()" class="menu_btn_open"></a></li>
                        <li><a href="index.html#APropos" class="menu-link">❔ A propos</a></li>
                        <li class="deroulant"><a href="index.html#Solutions" class="menu-link">💡 Nos solutions ▼</a></li>
                        
                        <li><a href="index.html#nosrealisations" class="menu-link">🔨 Nos réalisations</a></li>
                        <li><a href="index.html#AvisClients" class="menu-link">⭐ Avis</a></li>
                        <li><a href="index.html#ContactezNous" class="menu-link">📩 Contact</a></li>
                        
                    </ul>
                    <ul class="mainNav">
                        <?php if($this->estConnecte()){
                            echo'<li><a href="../utilisateur/deconnecte" name="deconnecte" class="hideOnMobile">🔨 Deconnexion</a></li>
                             <li><img src="../../../assets/images/icons-sport/badminton(1).png" alt="Photo de Profil" class="photoProfil"></li>';} ?>
                        <li><a href="index.html#ContactezNous" class="hideOnMobile">📩 Contact</a></li>
                        <li><a href="../reservationTerrain/displayReservationTerrain" class="hideOnMobile">⭐ Reservation</a></li>
                        <?php if(!$this->estConnecte()){echo'
                        <li><a href="../utilisateur/afficheFormConnexion" class="hideOnMobile">🔨 Connexion</a></li>';
                        }?>
                        <li class="deroulant"><a href="../evenement/afficheEvenement" class="hideOnMobile">💡 Evenement ▼</a></li>
                        <li><a href="http://'.$_SERVER['HTTP_HOST'].'GestionSalleDeSportSAE/modules/blog/views/reservation.html" class="hideOnMobile">❔ A propos</a></li>
                        <li><a href="../performance/affichePerf" class="hideOnMobile">💪 Mes Performances</a></li>


                        <li><img   src="/GestionSalleDeSportSAE/assets/images/burger-white.png" alt="bouton menu burger" onclick="showSidebar()" class="menu_btn_close"></li>
                        
                    </ul>
            
                </nav>
            </div>
        </header><?php
        }

    }

    ?>

