<?php
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
    
        <title>Fiche Détails</title>
        <script defer src="mode_sombre.js"></script>
        <link rel="stylesheet" href="style1.css" type="text/css">
        <link id="theme-link" rel="stylesheet" href="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>    
        <header>
            <div class="head">
                <ul>
                    <button id="toggle-mode">🌓</button>
                    <li><a class="fa fa-arrow-circle-right" href="Page_presentation.php"> Présentation</a></li>
                    <li><a class="fa fa-map-o" href="Page_recherche.php"> Recherche</a></li>
                </ul>
                <div class="head1">
                    <h2> <a href="Page_accueil.php">Paradise camp</a></h2>
                </div>
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature</p>
          
                <div class="menu-connexion">
                    <div class="boutton">
                        <a class="fa fa-user-o"> Mon espace</a>
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


        <div class="pagePanier">

            <h1>Mon Panier</h1>

            <?php
            if (!isset($_SESSION['panier']) || count($_SESSION['panier']) === 0) {
                echo "<div class='panierVide'>
                    <p>Votre panier est vide !!!</p>
                    </div>";
            } else {
                $totalGlobal = 0;
                echo "<div class='panier'>";
                
                foreach ($_SESSION['panier'] as $index => $voyage) {
                    $totalPersonne = $voyage['personnes'];
                    $prixBase = $voyage['prix_base'];
                    $activiteTotal = $voyage['activite'] * 60;
                    $cantineTotal = $voyage['cantine'] * 40;
                    $arcadeTotal = $voyage['arcade'] * 10;

                    $prixTotal = ($prixBase * $totalPersonne) + $activiteTotal + $cantineTotal + $arcadeTotal;
                    $totalGlobal += $prixTotal;

                    echo "<div class='voyage'>";
                    echo "<img src='" . $voyage['image'] . "' alt='" . $voyage['nom'] . "' width='150'>";
                    echo "<h3>" . $voyage['nom'] . "</h3>";
                    echo "<p>Personnes : " . $voyage['personnes'] . "</p>";
                    echo "<p>Prix par personne : " . $voyage['prix_base'] . "€  </p>";
                    echo "<p>Activités × " . $voyage['activite'] . " : " . $activiteTotal . "€</p>";
                    echo "<p>Cantine × " . $voyage['cantine'] . " : " . $cantineTotal . "€</p>";
                    echo "<p>Arcade × " . $voyage['arcade'] . " : " . $arcadeTotal . "€</p>";
                    echo "<strong>Total : " . $prixTotal . "€</strong><br>";
                    echo "<form action='supprimer_panier.php' method='post'>
                            <input type='hidden' name='index' value='$index'>
                            <button type='submit'>Supprimer</button>
                        </form>";
                    echo "</div><hr>";
                }

                echo "<h2>Total du panier : " . $totalGlobal . "€</h2>";
                echo "<div class='bouttonPayer'>";
                echo "<a href='paiement.php'><button>Payer</button></a>";
                echo "</div>";
                echo "</div>";
            }
            ?>

        </div>

<?php include 'footer.php'; ?>

</body>
</html>