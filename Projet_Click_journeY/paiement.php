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
            
            // Vérification si l'ID du voyage a été passé dans la requête POST
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // Chargement du fichier JSON contenant les voyages
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

                // Recherche du voyage correspondant à l'ID
                $voyage_reserve = null;
                foreach ($tab_voyage["voyages"] as $voyage) {
                    if ($voyage["id"] == $id) {
                        $voyage_reserve = $voyage;
                    }
                }

                if ($voyage_reserve) {
                    // Ajout de la réservation à l'utilisateur connecté
                    foreach ($tab_utilisateur["utilisateurs"] as &$utilisateur) {
                        if ($utilisateur['email'] == $_SESSION['email']) {
                            // Créer un objet de réservation avec les informations du voyage
                            $reservation = [
                                "nom_voyage" => $voyage_reserve["nom"],
                                "destination" => $voyage_reserve["destination"],
                                "hebergement" => $voyage_reserve["hebergement"],
                                "prix" => $voyage_reserve["prix"],
                                "debut" => $voyage_reserve["debut"],
                                "fin" => $voyage_reserve["fin"],
                                "personnes" => $voyage_reserve["personnes"],
                                "duree" => $voyage_reserve["duree"],
                                "date_reservation" => date('Y-m-d H:i'), // Ajout de la date de réservation
                            ];
        
                            // Ajouter la réservation à la liste des réservations de l'utilisateur
                            $utilisateur['reservations'][] = $reservation;
                        }
                    }
        
                    // Sauvegarder les changements dans le fichier utilisateurs.json
                    $fichier_encode = json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
                    file_put_contents($fichier_utilisateurs, $fichier_encode);


                    // Afficher le message de confirmation de réservation
                    echo "<h1>Réservation confirmée !</h1>";
                    echo "<p>Vous avez réservé le voyage : " . $voyage_reserve['nom'] . " pour " . $voyage_reserve['duree'] . " jours.</p>";
                    echo "<p><strong>Détails de la réservation :</strong><br>";
                    echo "Destination : " . $voyage_reserve['destination'] . "<br>";
                    echo "Hébergement : " . $voyage_reserve['hebergement'] . "<br>";
                    echo "Prix : " . $voyage_reserve['prix'] . "€<br>";
                    echo "Durée : " . $voyage_reserve['duree'] . " jours<br>";
                    echo "</p>";
                    echo "<a href='Page_accueil.php'>Retour à l'accueil</a>";
                } else {
                    echo "<p>Le voyage sélectionné est introuvable.</p>";
                }
            } else {
                echo "<p>Pas de voyage sélectionné.</p>";
            }
        ?>


        <fieldset>
            <p>Paiemment</p>
            <form action="Page_accueil.php" method="POST">
                
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
                <input type="text" name="prenom" class="champ" placeholder="numéro de carte" required/>
            </div>
            <br/>
    
            <div class="caption">
                date d'expiration 
            </div>
            <div class="zone">
                <input type="text" name="email" class="champ" placeholder="MM/AA" required />
            </div>
            <br/>
    
            <div class="caption_mdp">
                 CVV 
            </div>
            <div class="zone">
                <input type="password" name="password" class="champ" placeholder="CVV" required />
            </div>
            <br/>
    
            <div class="cliquer">
                <input type="submit" name="paiemment" value="Payer" class="champ"/>
            </div>
            <br/>
            </form>
        </fieldset>

        <?php require 'footer.php'; ?>

    </body>
</html>
