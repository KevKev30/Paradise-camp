<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
    
        <title>Paiement</title>
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
                    <li><a class="fa fa-arrow-circle-right" href="Page_presentation.php"> Presentation</a></li>
                    <li><a class="fa fa-map-o" href="Page_recherche.php"> Recherche</a></li>
                </ul>
                <div class="head1">
                    <h2> <a href="Page_accueil.php">Paradise camp</a></h2>
                </div>
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature</p>
              
                <div class="menu-connexion">
                    <div class="boutton"><a class="fa fa-user-o"> Mon espace</a>
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
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Veuillez vous connecter ou vous inscrire.'); window.location.href='connexion.php';</script>";
    exit;
}

if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
    $totalGlobal = 0;
    echo "<div class='recap'>";
    echo "<h1 class='titre-recap'>Récapitulatif de votre panier</h1>";

    foreach ($_SESSION['panier'] as $voyage) {
        $activiteTotal = $voyage['activite'] * 60;
        $cantineTotal = $voyage['cantine'] * 40;
        $arcadeTotal = $voyage['arcade'] * 10;
        $prixVoyage = ($voyage['prix_base'] * $voyage['personnes']) + $activiteTotal + $cantineTotal + $arcadeTotal;
        $totalGlobal += $prixVoyage;

        echo "<div class='item-recap'>";
        echo "<p>Voyage : " . $voyage['nom'] . "</p>";
        echo "<p>Personnes : " . $voyage['personnes'] . "</p>";
        echo "<p>Prix de base : " . $voyage['prix_base'] . "€ / personne</p>";
        echo "<p>Activités (" . $voyage['activite'] . " pers) : " . $activiteTotal . "€</p>";
        echo "<p>Cantine (" . $voyage['cantine'] . " pers) : " . $cantineTotal . "€</p>";
        echo "<p>Arcade (" . $voyage['arcade'] . " pers) : " . $arcadeTotal . "€</p>";
        echo "<p><strong>Total voyage : " . $prixVoyage . "€</strong></p>";
        echo "</div><hr>";
    }

    echo "<h2>Total global à payer : " . $totalGlobal . "€</h2>";

    require 'getapikey.php';
    $vendeur = 'MI-3_J';
    $transaction = "PRDC" . rand(100000000, 999999999);
    $api_key = getAPIKey($vendeur);
    $host = $_SERVER['HTTP_HOST'];
    $base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    $valeur_controle = md5($api_key . "#" . $transaction . "#" . $totalGlobal . "#" . $vendeur . "#http://".$host."/".$base_path."/retour_paiement.php?session=s#");

    echo "<form action='https://www.plateforme-smc.fr/cybank/' method='POST'>
        <input type='hidden' name='transaction' value='$transaction'>
        <input type='hidden' name='montant' value='$totalGlobal'>
        <input type='hidden' name='vendeur' value='$vendeur'>
        <input type='hidden' name='retour' value='http://".$host."/".$base_path."/retour_paiement.php?session=s'>
        <input type='hidden' name='control' value='$valeur_controle'>
        <div class='recap_payer'>
            <input type='submit' value='Payer maintenant'/>
        </div>
    </form>";

    echo "</div>";
} else {
    echo "<p>Votre panier est vide.</p>";
}
?>


        <?php require 'footer.php';?>
    </body>
</html>