<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    
        <title>Paiement</title>
        <link rel="stylesheet" href="style1.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <div class="head">
                <ul>
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
                            $connecte = isset($_SESSION['email']); 
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


            if (!isset($_SESSION['email'])){
                echo "<script>alert('Veuillez vous connecter ou vous inscrire.'); window.location.href='connexion.php';</script>";
            }

            if(isset($_SESSION['email'])){
                $email = $_SESSION['email'];

                if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                    $id = $_POST["id"];

                    $activite = 0;
                    $cantine = 0;
                    $arcade = 0;
    
                    if(isset($_POST["activite"])){
                        $activite = 60 * (int)$_POST["activite"];
                    }
                    if(isset($_POST["cantine"])){
                        $cantine = 40 * (int)$_POST["cantine"];
                    }
                    if(isset($_POST["arcade"])){
                        $arcade = 10 * (int)$_POST["arcade"];
                    }

                    $option = ["activite" => $_POST['activite'], "cantine" => $_POST['cantine'], "arcade" => $_POST['arcade']];
    
                    $fichier_voyages = "voyages.json";
                    $fichier_utilisateurs = "utilisateurs.json";
    
                    if (file_exists($fichier_voyages)) {
                        $contenu_fichier_voyages = file_get_contents($fichier_voyages);
                        $tab_voyage = json_decode($contenu_fichier_voyages, true);
                    }
    
                    if (file_exists($fichier_utilisateurs)) {
                        $contenu_fichier_utilisateurs = file_get_contents($fichier_utilisateurs);
                        $tab_utilisateur = json_decode($contenu_fichier_utilisateurs, true);
                    }
    
                    $voyage_reserve = null;
                    foreach ($tab_voyage["voyages"] as $voyage) {
                        if ($voyage["id"] == $id) {
                            $voyage_reserve = $voyage;
                            $prix_total = ($voyage_reserve['prix'] * $voyage_reserve['duree']) + $activite + $cantine + $arcade;
                        }
                    }
                    $reservation = [
                        "nom" => $voyage_reserve["nom"],
                        "destination" => $voyage_reserve["destination"],
                        "hebergement" => $voyage_reserve["hebergement"],
                        "prix" => $prix_total,
                        "debut" => $voyage_reserve["debut"],
                        "fin" => $voyage_reserve["fin"],
                        "personnes" => $voyage_reserve["personnes"],
                        "duree" => $voyage_reserve["duree"],
                        "date_reservation" => date('Y-m-d H:i'),
                        "image" => $voyage_reserve["image"],
                        "option" => $option
                    ];
                
                
            
                    $fichier_encode = json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
                    file_put_contents($fichier_utilisateurs, $fichier_encode);

                    $_SESSION['reservation'] = $reservation;
                }   

            }


            if (isset($_SESSION['reservation'])): 
        ?>
                <div class="recap">
                    <h1 class="titre-recap">Récapitulatif de votre réservation</h1>
                    <p>Voyage : <?php echo $_SESSION['reservation']['nom']; ?> (<?php echo $_SESSION['reservation']['duree']; ?> jours)</p>
                    <p>Destination : <?php echo $_SESSION['reservation']['destination']; ?></p>
                    <p>Hébergement : <?php echo $_SESSION['reservation']['hebergement']; ?></p>
                    <p>Prix total : <?php echo $_SESSION['reservation']['prix']; ?>€</p>
                    <p>Options :</p>
                    <?php if ($_SESSION['reservation']['option']['activite'] != 0 || $_SESSION['reservation']['option']['cantine'] != 0 || $_SESSION['reservation']['option']['arcade'] != 0){ 
                            if($_SESSION['reservation']['option']['activite'] != 0){
                                echo "<p>- Menu activité pour " . $_SESSION['reservation']['option']['activite'] . " personnes </p>";
                            }

                            if($_SESSION['reservation']['option']['cantine'] != 0){
                                echo "<p>- Cantine pour " . $_SESSION['reservation']['option']['cantine'] . " personnes </p>";
                            }
                            if($_SESSION['reservation']['option']['arcade'] != 0){
                                echo "<p>- Pass arcade pour " . $_SESSION['reservation']['option']['arcade'] . " personnes</p>";
                            }
                        }
                        else{
                            echo "<p>Sans options</p>";
                        }
                    ?>

                <?php endif; ?>
                <div class="doute">
                    <a class="fa fa-arrow-circle-right" href='details.php?id=<?php echo $id;?>'> Fiche détail</a> <br>
                </div>



                <?php 
                    require 'getapikey.php';
                    $vendeur = 'MI-3_J';
                    $transaction = "PRDC" . rand(100000000, 999999999);
                    $api_key = getAPIKey($vendeur);
                    $host = $_SERVER['HTTP_HOST'];

     
                    $base_path = dirname($_SERVER['SCRIPT_NAME']); 


                    $base_path = rtrim($base_path, '/');
                    $valeur_controle = md5($api_key . "#" . $transaction . "#" . $prix_total . "#" . $vendeur . "#http://".$host."/".$base_path."/retour_paiement.php?session=s#");

                    echo "<form action='https://www.plateforme-smc.fr/cybank/' method='POST'>
                    <input type='hidden' name='transaction' value='$transaction'>
                    <input type='hidden' name='montant' value='$prix_total'>
                    <input type='hidden' name='vendeur' value='$vendeur'>
                    <input type='hidden' name='retour' value='http://".$host."/".$base_path."/retour_paiement.php?session=s'>
                    <input type='hidden' name='control' value='$valeur_controle'>
                    <div class='recap_payer'>
                    <input type='submit' value='Payer maintenant'/>
                    </div>
                    </form>";
                ?>
            </div>

        <?php require 'footer.php';?>
    </body>
</html>
