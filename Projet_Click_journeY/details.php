<!DOCTYPE html>

<html>
    <head>
    
        <title>Fiche Détails</title>
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
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature</p>
          
                <div class="menu-connexion">
                    <div class="boutton">
                        <a class="fa fa-user-o"> Mon espace</a>
                        <div class="menu">
                            <a href="connexion.php">Connexion</a>
                            <a href="inscription.php">Inscription</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?php 
            if(isset($_GET["id"])){
                $id = $_GET["id"];
                
                $fichier = "voyages.json";
                if(file_exists($fichier)){
                    $contenu_fichier = file_get_contents($fichier);
                    $voyages = json_decode($contenu_fichier, true);
                }

                foreach($voyages["voyages"] as $dest){
                    if ($dest["id"] == $id){
                        echo "<h1><center>".$dest["nom"]."</center></h1>";
                        echo "<div class='details'>";
                        echo "<center><img class='image' src='".$dest["image"]."'></center>";
                        echo "<p>";
                        echo "Lieu : ".$dest['destination']." <br>";
                        echo "Nombre de personnes : ".$dest['personnes']." personnes <br>";
                        echo "Prix/nuit : ".$dest['prix']."€ <br>";
                        echo "durée : ".$dest['duree']." jours <br>";
                        echo "Du ".$dest['debut']." au ".$dest['fin'];
                        echo "</p>";
                    }
                }
            }
        ?>

        <p>
            Voici les options qu'on peut vous proposer : <br>
            <input type="checkbox" value="activite"/> Menu activité (randonnée, laser game, karting, accrobranche) : +60€/personne<br>
            <input type="checkbox" value="cantine"/> Cantine : +40€/personne <br>
            <input type="checkbox" value="arcade"> Pass arcade : +10€/personne <br>
        </p>
        <?php
            echo "<p><center><button type='submit'><a href=paiement.php?id='" . urlencode($id). "'>Réserver</button></a></center></p>";
        ?>
        </div>

        <?php require 'footer.php';?>

    </body>
</html>