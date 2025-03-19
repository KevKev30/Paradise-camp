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
                    <option>1 personne</option>
                    <option>2 à 3 personnes</option>
                    <option>4 à 5 personnes</option>
                    <option>6 à 9 personnes</option>
                    <option>10 personnes et plus</option>
                </select>
    
                <select name="hebergement">
                    <option>Type d'hébergement</option>
                    <option>Mobil-Homes</option>
                    <option>camping-Car</option>
                    <option>tente</option>
                    <option>Cabane dans les arbres</option>
                </select>
    
                <select name="prix">
                    <option>Prix</option>
                    <option>0€-100€</option>
                    <option>100€-200€</option>
                    <option>200€-400€</option>
                </select>
    
                <button class="recherche-boutton" type="submit"><a class="fa fa-search"> Rechercher</a></button>
            </div>
        </form>

        <?php 
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

        <div class="accroche"> Voici des campings et leurs hébergements que nous vous recommandons :</div>
        
            <div class="selection1">
                <img class="photo" src="image/selection1.jpg">
                <p>Mobil-home 7 personnes / Camping des Bois Dormants (Nice)
                <br>
                <br>
                Prix/Nuit: 140€</p>
            </div>
            <div class="selection1">
                <img class="photo" src="image/selection2.jpg">
                <p>Cabane 10 personnes / Camping des Chat Perchés (Grenoble)
                <br>
                <br>
                Prix/Nuit: 160€</p>
            </div>
            <div class="selection2">
                <img class="photo" src="image/selection3.jpg">
                <p>Tipi 2 personnes / Camping des Tipi Enchanté (Montpellier)
                <br>
                <br>
                Prix/Nuit: 120€</p>
            </div>
        </div>
        
        <?php require 'footer.php';?> 
    
    </body>
</html>