<?php

//use controllers\utilisateurController;

//require_once __DIR__ . '/../controllers/utilisateurController.php';

    class navebar
    {

        public function afficher(){
           // $deco = new utilisateurController();
            ?>
            <header>
            <div class="navBar">
                <a href="index.html" class="HeadTitle">...</a>
                <nav class="menuNavBar">
                    <ul class="sidebar">
                        <li><a class="sidebarBtnA"><img src="../../../assets/images/croix-blanche.png" alt="bouton menu burger"  onclick="hideSidebar()" class="menu_btn_open"></a></li>
                        <li><a href="index.html#APropos" class="menu-link">❔ A propos</a></li>
                        <li class="deroulant"><a href="index.html#Soltuions" class="menu-link">💡 Nos solutions ▼</a></li>
                        
                        <li><a href="index.html#nosrealisations" class="menu-link">🔨 Nos réalisations</a></li>
                        <li><a href="index.html#AvisClients" class="menu-link">⭐ Avis</a></li>
                        <li><a href="index.html#ContactezNous" class="menu-link">📩 Contact</a></li>
                        
                    </ul>
                    <ul class="mainNav">
                        <li><a href="index.html#ContactezNous" class="hideOnMobile">📩 Contact</a></li>
                        <li><a href="../reservationTerrain/displayReservationTerrain" class="hideOnMobile">⭐ Reservation</a></li>
                        <li><a href="../utilisateur/afficheFormConnexion" class="hideOnMobile">🔨 Utilisateur</a></li>
                        <li class="deroulant"><a href="../evenement/afficheEvenement" class="hideOnMobile">💡 Evenement ▼</a></li>
                        <li><a href="http://'.$_SERVER['HTTP_HOST'].'GestionSalleDeSportSAE/modules/blog/views/reservation.html" class="hideOnMobile">❔ A propos</a></li>
                <?php if(isset($_SESSION['id'])){
                    echo'<li><a type="submit" name="deconnexion" class="hideOnMobile">🔨 Deconnexion</a></li>';} ?>


                        <li><img   src="../../../assets/images/burger-white.png" alt="bouton menu burger" onclick="showSidebar()" class="menu_btn_close"></li>
                        
                    </ul>
            
                </nav>
            </div>
        </header><?php
        }

    }

    ?>

