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
                    <li><a class="fa fa-bandcamp" href="Page_accueil.php"> Accueil</a></li>
                    <li><a class="fa fa-arrow-circle-right" href="Page_presentation.php"> Presentation</a></li>
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
      
        <form action="Page_recherche.php" method="post">
            <div class="barre-recherche">
                <input type="text" placeholder="Saisissez ici votre destination" name="destination">
                <input type="date" id="arrivee" placeholder=" " name="debut"/>
                <input type="date" id="depart" placeholder=" " name="fin">
                <select name="personnes">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                </select>
                <select name="hebergement">
                    <option>Type d'hébergement</option>
                    <option>Mobil-Homes</option>
                    <option>Espace Vert</option>
                    <option>Cabane dans les arbres</option>
                </select>
    
                <input type="text" name="prix" placeholder="Saisissez le prix">
    
                <button class="recherche-boutton" type="submit"><a class="fa fa-search"> Rechercher</a></button>
            </div>
        </form>

        <?php

            $voyages = [
                [
                    "nom" => "Camping des Bois Dormants",
                    "destination" => "Nice",
                    "hebergement" => "Mobil-home",
                    "prix" => 300,
                    "personnes" => 7,
                    "image" => "image/selection1.jpg"
                ],
                [
                    "nom" => "Camping des chênes",
                    "destination" => "Marseille",
                    "hebergement" => "Mobil-home",
                    "prix" => 240,
                    "personnes" => 5,
                    "image" => "image/selection1.jpg"
                ],
                [
                    "nom" => "Camping du Logobi",
                    "destination" => "Agde",
                    "hebergement" => "Mobil-home",
                    "prix" => ,
                    "personnes" => 6,
                    "image" => "image/selection1.jpg"
                ],
                [
                    "nom" => "Camping La Mairdeux",
                    "destination" => "Nice",
                    "hebergement" => "Mobil-home",
                    "prix" => 140,
                    "personnes" => 7,
                    "image" => "image/selection1.jpg"
                ],
                [
                    "nom" => "Camping la Solution Finale",
                    "destination" => "Nice",
                    "hebergement" => "Mobil-home",
                    "prix" => 140,
                    "personnes" => 7,
                    "image" => "image/selection1.jpg"
                ]
            ];

            if (isset($_POST['destination']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['personnes']) && isset($_POST['hebergement']) && isset($_POST['prix'])){
                $destination = $_POST['destination'];
                $debut = $_POST['debut'];
                $fin = $_POST['fin'];
                $personnes = $_POST['personnes'];
                $hebergement = $_POST['hebergement'];
                $prix = $_POST['prix'];

                echo ("gblorgbfouqvfqurgvbsufgbuigbvfugiqvbjkhsvguifydsfhqsfvriugfrvgbuh");
            }
        ?>
        
        <?php require 'footer.php';?> 
    
    </body>
</html>