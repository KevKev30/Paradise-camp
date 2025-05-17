<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>

        <title>Administrateur</title>
        <script defer src="mode_sombre.js"></script>
        <link rel="stylesheet" href="style1.css" type="text/css">
        <link id="theme-link" rel="stylesheet" href="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <header>
            <script src="admin.js"></script>
            <div class="head">
                <ul>
                    <button id="toggle-mode">🌓</button>
                    <li><a class="fa fa-arrow-circle-right" href="Page_presentation.php"> Présentation</a></li>
                    <li><a class="fa fa-map-o" href="Page_recherche.php"> Recherche</a></li>
                </ul>
                <div class="head1">
                    <h2> <a href="Page_accueil.php">Paradise camp</a></h2>
                </div>
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature.</p>

                <div class="menu-connexion">
                    <div class="boutton">
                        <a class="fa fa-user-o"> Mon espace</a>
                        <div class="menu">
                        <?php 
                            $connecte = isset($_SESSION['id']); 
                            if ($connecte){
                                echo "<a href='deconnexion.php?'>Deconnexion</a>
                                    <a href='Page_profil.php'>Mon Profil</a>
                                    <div class='image_panier'>
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

        <?php 


            $fichier = 'utilisateurs.json';
            $contenu_fichier = file_get_contents($fichier);
            $tab_utilisateur = json_decode($contenu_fichier, true);

            echo '<div class="admin">
                    <p>Bonjour, Voici les personnes inscrites sur le site :</p>
                </div>';

            echo '<table cellpadding="5" border="3" cellspacing="5">
                    <tr class="top">
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>e-mail</th>
                        <th>Gestion</th>
                    </tr>';


            foreach ($tab_utilisateur['utilisateurs'] as  $index => $utilisateur) {
                echo "<tr>
                        <td>{$utilisateur['nom']}</td>
                        <td>{$utilisateur['prenom']}</td>
                        <td>{$utilisateur['email']}</td>
                        <td>
                            <button type='button' class='vip action' utilisateurID='{$utilisateur['id']}' role='promouvoir'>Promouvoir</button>
                            <button type='button' class='ban action' utilisateurID='{$utilisateur['id']}' role='bannir'>Bannir</button>
                        </td>
                    </tr>";
            }

            echo '</table>';

        ?>


        <?php require 'footer.php'; ?>

    </body>
</html>