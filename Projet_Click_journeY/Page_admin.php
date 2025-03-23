<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>

        <title>Administrateur</title>
        <link rel="stylesheet" href="style1.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <header>
            <div class="head">
                <ul>
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
                                $connecte = isset($_SESSION['email']); 
                                if ($connecte){
                                    echo "<a href='deconnexion.php?'>Deconnexion</a>
                                        <a href='Page_profil.php'>Mon Profil</a>";
                                    }
                                else {
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
                    <tr>
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
                            <form action='promotion.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='index' value='{$index}'>
                                <button type='submit' class='vip'>Promouvoir</button>
                            </form>
                            <form action='bannir.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='index' value='{$index}'>
                                <button type='submit' class='ban'>Bannir</button>
                            </form>
                        </td>
                    </tr>";
            }

            echo '</table>';

        ?>

        <script>
            document.querySelectorAll(".ban").forEach(button => {
                button.addEventListener("click", function(event) {
                    if (!confirm("Es-tu sûr de vouloir bannir cet utilisateur ?")) {
                        event.preventDefault();
                    }
                });
            });
        </script>


        <?php require 'footer.php'; ?>

    </body>
</html>