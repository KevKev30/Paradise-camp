<!DOCTYPE html>
<html>
    <head>
    
        <title>A propos du site</title>
        <link rel="stylesheet" href="style1.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>


    <body>
        <header>
            <div class="head">
                <ul>
                  <li><a class="fa fa-bandcamp" href="Page_accueil.php"> Accueil</a></li>
                  <li><a class="fa fa-map-o" href="Page_recherche.php"> Recherche</a></li>
                </ul>
                <div class="head1">
                    <h2> <a href="Page_accueil.php">Paradise camp</a></h2>
                </div>
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature.</p>
          
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

        <div class="recherche">
            <form method="GET" action="Page_recherche.html" >
                <input type="text" name="recherche" placeholder="Recherchez un camping" required/>
                <button type="submit">Rechercher</button>
            </form>
        </div>
      

        <div class="hebergement">
            <p>Découvrez Paradise Camp, l'agence parfaite pour tout campeur. <br>
                Que vous soyez en quête d'un séjour les pieds dans l'eau,  
                <br> d'une escapade en pleine nature ou d'une nuit sous les étoiles, nous avons ce qu'il vous faut !</p>
                <br>
                
                <h1>Paradise Camp : Vivez des moments inoubliables en famille</h1>
                
                <p>Paradise Camp vous propose une large sélection d'hébergements situés partout en <strong>France</strong>. <br> 
                Que vous rêviez d'un mobil-home moderne,   
                d'un espace pour vos tentes ou caravanes, ou encore d'un bungalow tout équipé dans les arbres, <br> 
                nous vous guiderons et proposerons divers environnements exceptionnels :
                <br>
                <ul>  
                    <li><strong>En bord de mer :</strong> Accès direct aux plages et activités nautiques.</li>  
                    <li><strong>En pleine forêt :</strong> Excursion en pleine nature.</li>  
                    <li><strong>Parc aquatique :</strong> Toboggans, piscines et jeux d'eau pour les grands et les petits.</li>  
                </ul> 
                </p>  
        </div>
        <div class="experience">
                 <ul>
                <li>Mobil-homes :</li>
                <img class="MH1" src="image/Mobil-home1.jpg">
                <img class="MH1" src="image/Mobil-home2.jpg">
                <img class="MH1" src="image/Mobil-home3.jpg">
                <p>Profitez du confort d'un <strong>mobil-home</strong> tout équipé avec une terasse, une climatisation et un espace de vie familial.
                    Idéal pour des vacances reposantes, avec tout le confort d'une maison au coeur de la nature.
                </p>
            </ul>
            <br>
            <br>
            <br>
            <ul>
                <li>Espaces Verts :</li>
                <img class="MH1" src="image/camping_car1.jpg">
                <img class="MH1" src="image/camping_car2.jpg">
                <img class="MH1" src="image/tente.jpg">
                <p>Notre agence propose de vastes <strong>espaces verts</strong> dédiés aux caravanes, camping-cars et tentes.
                    Installez-vous et profitez des nombreux services mis à diposition tel que des sanitaires, des branchements électriques ou encore des aires de vidange.
                </p>
            </ul>
            <br>
            <br>
            <br>
            <ul>
                <li>Cabanes dans les arbres :</li>
                <img class="MH1" src="image/cabane1.jpg">
                <img class="MH1" src="image/cabane2.jpg">
                <img class="MH1" src="image/cabane3.jpg">
                <p>Vivez une expérience unique en vous installant dans des <strong>cabanes en pleine forêt</strong>.
                    Perché dans les hamacs ou encore bercé par les bulles des jacuzzi, profitez d'une nuit magique en hauteur avec une vue imprenable sur les horizons. </p>
            </ul>
            <br>
            <br>
            <br>
        
            <ul>
                <li>Animation et Activités :</li>
                <img class="MH1" src="image/karaoke.jpg">
                <img class="MH1" src="image/club.jpg">
                <img class="MH1" src="image/piscine3.jpg">
                <div class="activites">
                <p>                   
                    1-Nous proposons des campings avec des espaces aquatiques adaptés à toute la famille. 
                    Vous trouverez des piscines chauffées, des toboggans, des jeux d'eau mais également des séances d'aquagym ainsi que des espaces bien-être avec spa et massages.<br>                       
                    2-Prolongez votre expérience avec les soirées à thèmes : Concert, spectacles, karaoké ou encore soirées mousses.<br>
                    3-Les plus jeunes pourront s'amuser et se défouler grâce aux <strong>clubs enfants</strong>, avec des activités adaptées à tout âge: chasse au trésor, ateliers créatifs, tournois sportifs.                      
                </p>
                </div>
            </ul>
        </div>

        <div class="accroche"> Voici des campings et leurs hébergements que nous vous recommandons :</div>
        
            <div class="selection1">
                <img class="photo" src="image/selectionmh1.jpg">
                <p>Camping des Bois Dormants - Nice
                <br>
                Mobil-home 7 personnes
                <br>
                Prix/Nuit: 400€
                <br>
                Durée : 14 jours</p>
                <a href="details.php?id=mh1">Voir les détails</a>
            </div>
            <div class="selection1">
                <img class="photo" src="image/selectionc1.jpg">
                <p>Camping des Chat Perchés - Annecy
                <br>
                Cabane 8 personnes
                <br>
                Prix/Nuit: 440€
                <br>
                Durée : 21 jours</p>
                <a href="details.php?id=c1">Voir les détails</a>
            </div>
            <div class="selection1">
                <img class="photo" src="image/selectionev4.jpg">
                <p>Les Flots Tranquilles - Calais
                <br>
                Espace vert 4 personnes
                <br>
                Prix/Nuit: 95€
                <br>
                Durée : 14 jours</p>
                <a href="details.php?id=ev4">Voir les détails</a>
            </div>
        </div>

        <?php require 'footer.php';?> 

    </body>
</html>