<?php session_start();?>

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
      
        <div class="barre_recherche">
            <form action="Page_recherche.php" method="get">
                <div class="groupe"> 

                    <label for="destination"> Destination </label>
                    <select name="destination">
                    <option value="">Destination</option>
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

                    <label for="arrivee"> Date d'Arrivée</label>
                    <input type="date" id="arrivee" name="debut"/>

                    <label for="depart"> Date de départ </label>
                    <input type="date" id="depart" name="fin"/>
                </div>
                    
                <div class="groupe">
                    <label for="personnes"> Nombre de voyageurs </label>
                    <select name="personnes">
                        <option value="0">Nombre de personnes</option>
                        <option value="1">1 voyageur</option>
                        <option value="2">2 voyageurs</option>
                        <option value="3">3 voyageurs</option>
                        <option value="4">4 voyageurs</option>
                        <option value="5">5 voyageurs</option>
                        <option value="6">6 voyageurs</option>
                        <option value="7">7 voyageurs</option>
                        <option value="8">8 voyageurs</option>
                    </select>

                    <label for="hebergement"> Type d'hébergement </label>
                    <select name="hebergement">
                        <option value="Mobil-home">Mobil-Home</option>
                        <option value="Espace vert">Espace Vert</option>
                        <option value="Cabane">Cabane dans les arbres</option>
                    </select>

                    <label for="prix"> Prix Maximal </label>
                    <select name="prix">
                        <option value="0">Aucun maximum</option>
                        <option value="200">200€</option>
                        <option value="300">300€</option>
                        <option value="400">400€</option>
                        <option value="500">500€</option>
                        <option value="600">600€</option>
                    </select>
                </div>

                <div class="recherche-boutton">
                    <input type="submit" value="Rechercher"/>
                </div>
            </form>
        </div>

        <?php 

            $voyages_par_page = 5;
            $offset = ($page_actuelle - 1) * $voyages_par_page;
            if (isset($_GET['page'])){
                $page_actuelle = (int)$_GET['page'];
            }
            else{
                $page_actuelle = 1;
            }

            $voyages_trouves = [];

            if (!empty($_GET['destination'])){

                $destination = $_GET['destination'] ?? '';
                $personnes = $_GET['personnes'] ?? 0;
                $hebergement = $_GET['hebergement'] ?? '';
                $prix = $_GET['prix'] ?? 0;
                $count = 0;

                $prix = (int)$prix;
                $personnes = (int)$personnes;
                
                if(empty($_GET['debut'])){
                    if(empty($_GET['fin'])){
                        $debut = 0;
                        $fin = 0;
                    }
                    else{
                        echo "<script>alert('Sélectionnez une date d'arrivée.'); window.location.href='Page_recherche.php';</script>";
                    }
                }
                else{
                    if(empty($_GET['fin'])){
                        echo "<script>alert('Sélectionnez une date de départ.'); window.location.href='Page_recherche.php';</script>";
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
                        $voyage_debut = new DateTime($dest['debut']);
                        $voyage_fin = new DateTime($dest['fin']);
                        if (
                           (($dest['destination'] == $destination) || ($destination == "")) && 
                           (($dest['hebergement'] == $hebergement) || ($hebergement == "")) && 
                           (($dest['prix'] <= $prix) || ($prix == 0)) && 
                           (($dest['personnes'] == $personnes) || ($personnes == 0)) && 
                           (($voyage_debut == $start) && ($voyage_fin == $end) || ($debut == 0 && $fin == 0))
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
                        echo "<a href='details.php?id=".urlencode($id)."' class='selection_lien'>";
                        echo "<div class='selection1'>";
                        echo "<img class='photo' src='" . htmlspecialchars($dest['image']) . "'>";
                        echo "<p>" . htmlspecialchars($dest['nom']) . "-" . htmlspecialchars($dest['destination']);
                        echo "<br>";
                        echo "Nombre de personnes : " . $dest['personnes'];
                        echo "<br>";
                        echo "Prix/nuit: " . $dest['prix'] . "€";
                        echo "<br>";
                        echo "Durée : " . $dest['duree'] . " jours </p>";
                        echo "</div>";
                        echo "</a>";
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