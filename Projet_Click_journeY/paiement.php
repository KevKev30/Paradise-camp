<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    
        <title>Recherchez votre séjour</title>
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
                            <a href="connexion.php">Connexion</a>
                            <a href="inscription.php">Inscription</a>
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
    
                    if ($voyage_reserve != null) {
                        foreach ($tab_utilisateur["utilisateurs"] as $utilisateur) {
                            if ($utilisateur['email'] == $email) {
                                $reservation = [
                                    "nom_voyage" => $voyage_reserve["nom"],
                                    "destination" => $voyage_reserve["destination"],
                                    "hebergement" => $voyage_reserve["hebergement"],
                                    "prix" => $voyage_reserve["prix"],
                                    "debut" => $voyage_reserve["debut"],
                                    "fin" => $voyage_reserve["fin"],
                                    "personnes" => $voyage_reserve["personnes"],
                                    "duree" => $voyage_reserve["duree"],
                                    "date_reservation" => date('Y-m-d H:i'),
                                    "option" => $option
                                ];
                                $utilisateur['reservations'][] = $reservation;
                            }
                        }
            
                        $fichier_encode = json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
                        file_put_contents($fichier_utilisateurs, $fichier_encode);

                        $_SESSION['reservation'] = $reservation;

                        if(isset($_SESSION['reservation'])){
                            $reservation = $_SESSION['reservation'];
                            echo "<h1>Recap</h1>";
                            echo "<p>Vous avez réservé le voyage : " . $reservation['nom'] . " pour " . $reservation['duree'] . " jours.</p>";
                            echo "<p><strong>Détails de la réservation :</strong><br>";
                            echo "Destination : " . $reservation['destination'] . "<br>";
                            echo "Hébergement : " . $reervation['hebergement'] . "<br>";
                            echo "Prix total: " . $prix_total . "€<br>";
                            echo "Durée : " . $reservation['duree'] . " jours<br>";
                            echo "Option : <br>";
                            if ($activite != 0 && $cantine != 0 && $arcade != 0){ 
                                if($activite != 0){
                                    echo "Menu activité pour " . $_POST['activite'] . " personnes <br>";
                                }
        
                                if($cantine != 0){
                                    echo "Cantine pour " . $_POST['cantine'] . " personnes <br>";
                                }
                                if($arcade != 0){
                                    echo "Pass arcade pour " . $_POST['arcade'] . " personnes <br>";
                                }
                            }
                            else{
                                echo "Sans options";
                            }
                            echo "</p>";
                            echo "<br>";
                            echo "<a href='details.php?id=". $id."'>Un petit doute ?</a> <br>";
                        } 
                    }
                    else {
                        echo "<p>Le voyage sélectionné est introuvable.</p>";
                    }
                } 
                else {
                    echo "<p>Pas de voyage sélectionné.</p>";
                }
            }

        ?>

        <fieldset>
            <p>Paiement</p>
            <form action="paiement.php" method="POST">
                
            <div class="caption">
                Titulaire de la carte
            </div>
            <div class="zone">
                <input type="text" name="nom" class="champ" placeholder="Prénom nom" required/>
            </div>
            <br/>
    
            <div class="caption">
                numéro
            </div>
            <div class="zone">
                <input type="text" name="numero" class="champ" placeholder="numéro de carte" maxlength="16" required/>
            </div>
            <br/>
    
            <div class="caption">
                date d'expiration 
            </div>
            <div class="zone">
                <input type="text" name="date" class="champ" placeholder="MM/AA" maxlength="5" required />
            </div>
            <br/>
    
            <div class="caption_mdp">
                 CVV 
            </div>
            <div class="zone">
                <input type="text" name="cvv" class="champ" placeholder="CVV" maxlength="3" required />
            </div>
            <br/>
    
            <div class="cliquer">
                <input type="submit" name="paiement" value="Payer" class="champ"/>
            </div>
            <br/>
            </form>
        </fieldset>



        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                if (isset($_POST['nom']) && isset($_POST['numero']) && isset($_POST['date']) && isset($_POST['cvv'])){
                    $nom = $_POST['nom'];
                    $numero = $_POST['numero'];
                    $date = $_POST['date'];
                    $cvv = $_POST['cvv'];

                    $tab_date = explode("/", $date);
                    if (
                    (!is_numeric($numero) || !is_numeric($cvv)) &&
                    (((int)$tab_date[0] < 1 || (int)$tab_date[0] > 12) || 
                    ((int)$tab_date[0] < 3 && (int)$tab_date[1] <= 25)) ){
                        echo "<script>alert('Information incorrecte ou carte expirée.'); window.location.href='paiement.php';</script>";
                    }
                    else{
                        $transaction = "TXN" . rand(1000, 9999) . strtoupper(substr(md5(rand()), 0, 4));
                        $vendeur = "MI-3_J";
                        $retour = "retour_paiement.php";
                        $control = md5($transaction . "#" . $prix_total . "#" . $vendeur . "#" . $retour);

                        header("Location: $retour?transaction=$transaction&montant=$prix_total&vendeur=$vendeur&statut=accepted&control=$control");
                        exit;
                    }
                }
            }
            
            require 'footer.php'; 

        ?>

    </body>
</html>
