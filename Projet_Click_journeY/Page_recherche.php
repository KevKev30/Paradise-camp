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
      
        <form action="Page_recherche.php" method="get">

            <div class="barre-recherche">

                <select name="destination">
                    <option value="">Destinations</option>
                    <option value="Marseille">Marseille</option>
                    <option value="Nice">Nice</option>
                    <option value="Agde">Agde</option>
                    <option value="Cormeilles">Cormeilles</option>
                    <option value="Lyon">Lyon</option>
                    <option value="Annecy">Annecy</option>
                    <option value="La Rochelle">La Rochelle</option>
                    <option value="Bordeaux">Bordeaux</option>
                </select>

                <input type="date" id="arrivee" placeholder=" " name="debut"/>

                <input type="date" id="depart" placeholder=" " name="fin">

                <select name="personnes">
                    <option>Nombre de personnes</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>

                <select name="hebergement">
                    <option value="">Type d'hébergement</option>
                    <option value="Mobil-home">Mobil-Home</option>
                    <option value="Espace vert">Espace Vert</option>
                    <option value="Cabane">Cabane dans les arbres</option>
                </select>
    
                <select name="prix">
                    <option value="">Prix Maximal</option>
                    <option value="100">100€</option>
                    <option value="200">200€</option>
                    <option value="300">300€</option>
                    <option value="400">400€</option>
                    <option value="500">500€</option>
                    <option value="600">600€</option>
                </select>
    
                <button class="recherche-boutton" type="submit"><a class="fa fa-search"> Rechercher</a></button>

            </div>
        </form>

        <?php 

            $voyages = [
                [
                    "nom" => "Camping des Bois Dormants",
                    "destination" => "Nice",
                    "hebergement" => "Mobil-home",
                    "prix" => 400,
                    "personnes" => 7,
                    "duree" => 14,
                    "image" => "image/selection2.jpg"
                ],
                [
                    "nom" => "Camping Des Chênes",
                    "destination" => "Marseille",
                    "hebergement" => "Mobil-home",
                    "prix" => 240,
                    "personnes" => 5,
                    "duree" => 21,
                    "image" => "image/selection3.jpg"
                ],
                [
                    "nom" => "Camping Le Paradis Marin",
                    "destination" => "Agde",
                    "hebergement" => "Mobil-home",
                    "prix" => 280,
                    "personnes" => 6,
                    "duree" => 14,
                    "image" => "image/selection4.jpg"
                ],
                [
                    "nom" => "Camping des Dunes Dorées",
                    "destination" => "La Rochelle",
                    "hebergement" => "Mobil-home",
                    "prix" => 350,
                    "personnes" => 7,
                    "duree" => 14,
                    "image" => "image/selection5.jpg"
                ],
                [
                    "nom" => "Camping Le Lagon Azur",
                    "destination" => "Bordeaux",
                    "hebergement" => "Mobil-home",
                    "prix" => 450,
                    "personnes" => 8,
                    "duree" => 21,
                    "image" => "image/selection1.jpg"
                ]
            ];

            if (isset($_GET['destination']) && isset($_GET['debut']) && isset($_GET['fin']) && isset($_GET['personnes']) && isset($_GET['hebergement']) && isset($_GET['prix'])){

                $destination = $_GET['destination'];
                $personnes = $_GET['personnes'];
                $hebergement = $_GET['hebergement'];
                $prix = $_GET['prix'];

                $prix = (int)$prix;
                $personnes = (int)$personnes;

                $resultat = [];

                if(empty($_GET['debut'])){
                    if(empty($_GET['fin'])){
                        $duree = 0;
                    }
                    else{
                        echo "<script>alert('Entrez une date de départ'); window.location.href='Page_recherche.php';</script>";
                    }
                }
                else{
                    if (empty($_GET['fin'])){
                        echo "<script>alert('Entrez une date de fin'); window.location.href='Page_recherche.php';</script>"; 
                    }
                    else{
                        $debut = $_GET['debut'];
                        $fin = $_GET['fin'];

                        $start = new DateTime($debut);
                        $end = new DateTime($fin);
                        $duree = date_diff($start, $end)->days;
                    }
                }


                foreach($voyages as $dest){
                    if ((($dest['destination'] == $destination) || ($destination == "")) && (($dest['hebergement'] == $hebergement) || ($hebergement == "")) && (($dest['prix'] <= $prix) || (is_null($prix))) && (($dest['personnes'] == $personnes) || (is_null($personnes))) && (($dest['duree'] == $duree) || $duree == 0)){
                        $resultat[] = $dest;
                    }
                }
                if(count($resultat) > 0){
                    foreach($resultat as $res){
                        echo "<div class='selection1'>";
                        echo "<img class='photo' src='".htmlspecialchars($res['image'])."'>";
                        echo "<p>".htmlspecialchars($res['nom'])." ".$res['personnes']." personnes / ".htmlspecialchars($res['destination']);
                        echo "<br>";
                        echo "Prix/nuit: ".$res['prix']."€";
                        echo "<br>";
                        echo "Durée : ".$res['duree']." jours </p>";
                        echo "</div>";
                    }
                }
                else{
                    echo "<p> Aucun camping ne corresponds à vos recherches. </p>";
                }
            }

            require 'footer.php';
        ?>
    
    </body>
</html>