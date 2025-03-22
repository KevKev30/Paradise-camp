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
                    <option value="Lyon">Lyon</option>
                    <option value="Annecy">Annecy</option>
                    <option value="La Rochelle">La Rochelle</option>
                    <option value="Bordeaux">Bordeaux</option>
                    <option value="Caen">Caen</option>
                    <option value="Montpellier">Montpellier</option>
                    <option value="Les Sables d'Olonne">Les Sables d'Olonne</option>
                    <option value="Calais">Calais</option>
                    <option value="Montaigu">Montaigu</option>
                    <option value="Limoges">Limoges</option>
                </select>

                <input type="date" id="arrivee" placeholder=" " name="debut" min="2025-06-01" max="2025-08-31"/>

                <input type="date" id="depart" placeholder=" " name="fin" min="2025-06-01" max="2025-08-31">

                <select name="personnes">
                    <option value="0">Nombre de personnes</option>
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
                    <option value="0">Prix Maximal</option>
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
            session_start();

            $voyages_par_page = 5;
            $offset = ($page_actuelle - 1) * $voyages_par_page;
            if (isset($_GET['page'])){
                $page_actuelle = (int)$_GET['page'];
            }
            else{
                $page_actuelle = 1;
            }

            $voyages_trouves = [];

            if (isset($_GET['destination']) && isset($_GET['debut']) && isset($_GET['fin']) && isset($_GET['personnes']) && isset($_GET['hebergement']) && isset($_GET['prix'])){

                $destination = $_GET['destination'];
                $personnes = $_GET['personnes'];
                $hebergement = $_GET['hebergement'];
                $prix = $_GET['prix'];
                $count = 0;

                $prix = (int)$prix;
                $personnes = (int)$personnes;

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

                $fichier = 'voyages.json';
                if(file_exists($fichier)){
                    $contenu_fichier = file_get_contents($fichier);
                    $voyages = json_decode($contenu_fichier, true);

                    foreach($voyages['voyages'] as $dest){
                        if (
                           (($dest['destination'] == $destination) || ($destination == "")) && 
                           (($dest['hebergement'] == $hebergement) || ($hebergement == "")) && 
                           (($dest['prix'] <= $prix) || ($prix == 0)) && 
                           (($dest['personnes'] == $personnes) || ($personne == 0)) && 
                           (($dest['duree'] == $duree) || ($duree == 0)) &&
                           (($dest['debut'] == $debut) && ($dest['fin'] == $fin))
                           )
                        {
                            $voyages_trouves[] = $dest;
                        }
                    }

                    $total_voyages = count($voyages_trouves);
                    $total_pages = ceil($total_voyages / $voyages_par_page);
                    $voyages_affiches = array_slice($voyages_trouves, $offset, $voyages_par_page);

                    foreach ($voyages_affiches as $dest) {
                        $id = $dest['id'];
                        echo "<div class='selection1'>";
                        echo "<img class='photo' src='" . htmlspecialchars($dest['image']) . "'>";
                        echo "<p>" . htmlspecialchars($dest['nom']) . "-" . htmlspecialchars($dest['destination']);
                        echo "<br>";
                        echo "Nombre de personnes : " . $dest['personnes'];
                        echo "<br>";
                        echo "Prix/nuit: " . $dest['prix'] . "€";
                        echo "<br>";
                        echo "Durée : " . $dest['duree'] . " jours </p>";
                        echo "<a href='details.php?id=" . urlencode($id) . "'> Voir les détails </a>";
                        echo "</div>";
                        $count++;
                    }

                    if ($total_pages > 1) {
                        echo "<div class='pagination'>";
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page_actuelle) {
                                echo "<strong>$i</strong> ";
                            } else {
                                echo "<a href='Page_recherche.php?" . http_build_query($_GET) . "&page=$i'>$i</a> ";
                            }
                        }
                        echo "</div>";
                    }

                    if($count == 0){
                        echo "<script>alert('Aucun camping ne correspond à vos recherches.'); window.location.href='Page_recherche.php';</script>";
                    }
                }
            }
            require 'footer.php';
        ?>
    </body>
</html>