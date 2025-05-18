<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
    
        <title>Recherchez votre séjour</title>
        <script defer src="mode_sombre.js"></script>
        <link rel="stylesheet" href="style1.css" type="text/css">
        <link id="theme-link" rel="stylesheet" href="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="recherche.js"></script>
    </head>
    <body>
        <header>
            <div class="head">
                <ul>
                    <button id="toggle-mode">🌓</button>
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
      
        <div class="barre_recherche">
            <form action="Page_recherche.php" method="get">
                <div class="groupe">

                    <label for="destination"> Destination </label>
                    <select name="destination" id="destination">
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
                    <input type="date" id="arrivee" name="debut" min="2025-06-01" max="2025-08-24"/>

                    <label for="depart"> Date de départ </label>
                    <input type="date" id="depart" name="fin" min="2025-06-01" max="2025-08-31"/>
                </div>
                    
                <div class="groupe">
                    <label for="personnes"> Nombre de voyageurs </label>
                    <select name="personnes" id="personnes">
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
                    <select name="hebergement" id="hebergement">
                        <option value="">Tout type</option>
                        <option value="Mobil-home">Mobil-Home</option>
                        <option value="Espace vert">Espace Vert</option>
                        <option value="Cabane">Cabane dans les arbres</option>
                    </select>

                    <label for="prix"> Prix Maximal </label>
                    <select name="prix" id="prix">
                        <option value="0">Aucun maximum</option>
                        <option value="200">200€</option>
                        <option value="300">300€</option>
                        <option value="400">400€</option>
                        <option value="500">500€</option>
                        <option value="600">600€</option>
                    </select>

                    <label for="filtres"> Filtres </label>
                    <select name="filtres" id="filtres" data-extra="<?php echo $_GET['filtres']; ?>">
                        <option value="vide">Filtres</option>
                        <option value="prix">Prix</option>
                        <option value="duree">Durée</option>
                        <option value="personnes">Nombre de voyageurs</option>
                    </select>
                </div>
                <div class="recherche-boutton">
                    <input type="submit" value="Rechercher"/>
                </div>
            </form>
        </div>

        <div id="resultats">

            <?php 
                if (isset($_GET['page'])){
                    $page_actuelle = (int)$_GET['page'];
                }
                else{
                    $page_actuelle = 1;
                }

                $voyages_par_page = 5;
                $offset = ($page_actuelle - 1) * $voyages_par_page;
                

                $voyages_trouves = [];

                if (isset($_GET['destination']) && isset($_GET['debut']) && isset($_GET['fin']) && isset($_GET['personnes']) && isset($_GET['hebergement']) && isset($_GET['prix'])){

                    $destination = $_GET['destination'];
                    $personnes = $_GET['personnes'];
                    $hebergement = $_GET['hebergement'];
                    $prix = $_GET['prix'];
                    $count = 0;

                    $prix = (int)$prix;
                    $personnes = (int)$personnes;

                    $fichier = 'voyages.json';
                    if(file_exists($fichier)){
                        $contenu_fichier = file_get_contents($fichier);
                        $voyages = json_decode($contenu_fichier, true);

                        if(empty($_GET['debut']) && empty($_GET['fin'])){
                        foreach($voyages['voyages'] as $dest){
                            $voyages_trouves[] = $dest;
                        }
                        }
                        else if (empty($_GET['debut'])){
                            echo "<script>alert('Sélectionnez une date d'arrivée.'); window.location.href='Page_recherche.php';</script>";
                        }
                        else if (empty($_GET['fin'])){
                            echo "<script>alert('Sélectionnez une date de départ.'); window.location.href='Page_recherche.php';</script>";
                        }
                        else{
                            $debut = $_GET['debut'];
                            $fin = $_GET['fin'];

                            $start = new DateTime($debut);
                            $end = new DateTime($fin);

                            $diff = (int)date_diff($start, $end)->format('%R%a');

                            if ($diff <= 0){
                                echo "<script>alert('Les dates choisies ne sont pas correctes.'); window.location.href='Page_recherche.php';</script>";
                            }

                            foreach($voyages['voyages'] as $dest){
                                $voyage_debut = new DateTime($dest['debut']);
                                $voyage_fin = new DateTime($dest['fin']);
                                if (
                                (($dest['destination'] == $destination) || ($destination == "")) && 
                                (($dest['hebergement'] == $hebergement) || ($hebergement == "")) && 
                                (($dest['prix'] <= $prix) || ($prix == 0)) && 
                                (($dest['personnes'] == $personnes) || ($personnes == 0)) && 
                                (((int)date_diff($start, $voyage_debut)->format('%R%a') >= 0) && ((int)date_diff($voyage_fin, $end)->format('%R%a') >= 0))
                                )
                                {
                                    $voyages_trouves[] = $dest;
                                }
                            }
                        }

                        $total_voyages = count($voyages_trouves);
                        $total_pages = ceil($total_voyages / $voyages_par_page);
                        $voyages_affiches = array_slice($voyages_trouves, $offset, $voyages_par_page);

                        foreach ($voyages_trouves as $dest) {
                            $id = $dest['id'];
                            if ($count >= 5){
                                echo "<a hidden href='details.php?id=".urlencode($id)."' class='selection_lien' data-extra='".$dest["prix"]."' data-extra2='".$dest["duree"]."' data-extra3='".$dest["personnes"]."'>";
                            }
                            else{
                                echo "<a href='details.php?id=".urlencode($id)."' class='selection_lien' data-extra='".$dest["prix"]."' data-extra2='".$dest["duree"]."' data-extra3='".$dest["personnes"]."'>";
                            }
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
                            echo "<div class='pagination' id='pagi' data-extra='1'>";
                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == 1){
                                    echo '<button class="page_actuelle" onclick="pagination('.$i.')">'.$i.'</button>';
                                }
                                else{
                                    echo '<button onclick="pagination('.$i.')">'.$i.'</button>';
                                }
                            }
                            echo "</div>";
                        }

                        if($count == 0){
                            echo "<h1><center>Aucun résultat ne corresponds à vos recherches.</center></h1>";
                        }
                    }
                }
            ?>

        </div>

        <script type="text/javascript">
            var filtres = document.getElementById("filtres");
            filtres.addEventListener("change", triFiltres);
            window.addEventListener("load", triFiltres);
        </script>


        <?php require 'footer.php'; ?>
            
    </body>
</html>