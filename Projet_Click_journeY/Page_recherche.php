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
                    <li><a class="fa fa-bandcamp" href="Page_accueil.html"> Accueil</a></li>
                    <li><a class="fa fa-arrow-circle-right" href="Page_presentation.html"> Presentation</a></li>
                </ul>
                <div class="head1">
                    <h2> <a href="Page_accueil.html">Paradise camp</a></h2>
                </div>
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature</p>
              
                <div class="menu-connexion">
                    <div class="boutton"><a class="fa fa-user-o"> Mon espace</a>
                        <div class="menu">
                            <a href="connexion.html">Connexion</a>
                            <a href="inscription.html">Inscription</a>
                        </div>
                    </div>
                </div>
            </div>  
        </header>
      
        <form action="Page_recherche.php" method="post">
        <div class="barre-recherche">
            <input type="text" placeholder="Saisissez ici votre destination">
            <input type="date" id="arrivee" placeholder=" " />
            <input type="date" id="depart" placeholder=" ">
            <select>
                <option>1 personne</option>
                <option>2 à 3 personnes</option>
                <option>4 à 5 personnes</option>
                <option>6 à 9 personnes</option>
                <option>10 personnes et plus</option>
            </select>
    
            <select>
                <option>Type d'hébergement</option>
                <option>Mobil-Homes</option>
                <option>camping-Car</option>
                <option>tente</option>
                <option>Cabane dans les arbres</option>
            </select>
    
            <select>
                <option>Prix</option>
                <option>0€-100€</option>
                <option>100€-200€</option>
                <option>200€-400€</option>
            </select>
    
            <button class="recherche-boutton"><a class="fa fa-search"> Rechercher</a></button>
        </div>
        </form>


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
    
        <footer>

            <div class="footer-gauche">
                <div class="icone">
                    <a class="fa fa-facebook-square" href="https://www.facebook.com/"></a>
                </div>
                <div class="icone1">
                    <a class="fa fa-instagram" href="https://www.instagram.com/"></a>
                </div>
                <div class="icone2">
                    <a class="fa fa-twitter"  href="https://www.twitter.com/"></a>
                </div>
            </div>

            <div class="footer-central">
                <h2>Nous contacter</h2>
                <span class="fa fa-phone"></span>
                <span class="text">01.01.01.01.01</span>
                <br>
                <span class="fa fa-envelope"></span>
                <span class="text">paradise.camp@gmail.com</span>
                <br>
                <span class="fa fa-map-marker"></span>
                <span class="text">Avenue du Parc, 95000 Cergy-Pontoise Cedex</span>
            </div>

            <div class="footer-droit">
                <div class="text">Email</div>
                <input type="text" name="email" class="champ" required >
                <div class="text">Message</div>
                <textarea rows="5" cols="50"></textarea>
                <div class="btn">
                    <button type="submit">Envoyer</button>
                </div>
            </div>

            <div class="bas">
                <p>Agence de voyage réalisée par Kevin NGUYEN OANH, Axel EDOUARD, Anaëlle JOACHIM. © 2024-2025 - <a href="https://cytech.cyu.fr/">CY Tech</a> </p>
            </div>
        </footer>
    
    </body>
</html>