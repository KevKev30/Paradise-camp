<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
        <title>Paradise Camp</title>
        <script defer src="mode_sombre.js"></script>
        <link rel="stylesheet" href="style1.css" type="text/css">
        <link id="theme-link" rel="stylesheet" href="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>


    <body>
        <header>
            <div class="head_accueil">
                <ul>
                    <button id="toggle-mode">🌓</button>
                    <li><a class="fa fa-arrow-circle-right" href="Page_presentation.php"> Présentation</a></li>
                    <li><a class="fa fa-map-o" href="Page_recherche.php"> Recherche</a></li>
                </ul>
                <div class="head2">
                    <h2><a href="Page_accueil.php">Paradise camp</a><h2>
                </div>
                <p>
                    Vous souhaitez vivre un séjour inoubliable en famille, en vous reconnectant avec la nature tout en profitant des vacances en toute liberté. Entre plage, forêt et parc aquatique, choisissez votre destination et laissez-vous porter par l'aventure.
                </p>
            
          
                <div class="menu-connexion">
                    <div class="boutton"><a class="fa fa-user-o"> Mon espace</a>
                        <div class="menu">
                        <?php 
                            $connecte = isset($_SESSION['id']); 
                            if ($connecte){

                                $fichier = 'utilisateurs.json';

                                $contenu_fichier=file_get_contents($fichier);
                                $utilisateurs =json_decode($contenu_fichier, true); 

                                $tableau_utilisateur = $utilisateurs['utilisateurs'];

                                $utilisateurConnecte = null;

                                foreach($tableau_utilisateur as $uti){
                                    if ($uti['id'] == $_SESSION['id']){
                                        $utilisateurConnecte = $uti;
                                    }
                                }
                                echo "<a href='deconnexion.php?'>Deconnexion</a>
                                    <a href='Page_profil.php'>Mon Profil</a>";

                                if($utilisateurConnecte && $utilisateurConnecte['role'] === 'Administrateur'){
                                    echo "<a href='Page_admin.php'> Admin </a>";
                                }

                                echo "<div class='image_panier'>
                                    <a class='fa fa-shopping-cart' href='panier.php'></a>";

                                $nbArticles = isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0;
                                echo "<span>$nbArticles</span>
                                    </div>";

                            } else {
                                echo "<a href='connexion.php?'>Connexion</a>
                                    <a href='inscription.php'>Inscription</a>";
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>        
        </header>



        <footer class="footer_accueil">

            <div class="footer-gauche">
                <div class="icone">
                    <a class="fa fa-facebook-square" href="https://www.facebook.com/"></a>
                </div>
                <div class="icone1">
                    <a class="fa fa-instagram" href="https://www.instagram.com/"></a>
                </div>
                <div class="icone2">
                    <a class="fa fa-twitter"  href="https://www.twitter.com/"></a>
                </div>
            </div>

            <div class="footer-central">
                <h2>Nous contacter</h2>
                <span class="fa fa-phone"></span>
                <span class="text">01.01.01.01.01</span>
                <br>
                <span class="fa fa-envelope"></span>
                <span class="text">paradise.camp@gmail.com</span>
                <br>
                <span class="fa fa-map-marker"></span>
                <span class="text">Avenue du Parc, 95000 Cergy-Pontoise Cedex</span>
            </div>

            <div class="footer-droit">
                <div class="text">Email</div>
                <input type="text" name="email" class="champ" required >
                <div class="text">Message</div>
                <textarea rows="5" cols="50"></textarea>
                <div class="btn">
                    <button type="submit">Envoyer</button>
                </div>
            </div>

            <div class="bas">
                <p>Agence de voyage réalisée par Kevin NGUYEN OANH, Axel EDOUARD, Anaëlle JOACHIM. © 2024-2025 - <a href="https://cytech.cyu.fr/">CY Tech</a> </p>
            </div>
        </footer>
    </body>
</html>