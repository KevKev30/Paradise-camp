<?php 
session_start();

if (
    isset($_GET['ajax']) && $_GET['ajax'] === 'prix' &&
    isset($_GET['id']) &&
    isset($_GET['activite']) &&
    isset($_GET['cantine']) &&
    isset($_GET['arcade'])
) {
    header('Content-Type: application/json');

    $id = $_GET['id'];
    $activite = intval($_GET['activite']);
    $cantine = intval($_GET['cantine']);
    $arcade = intval($_GET['arcade']);

    $fichier = "voyages.json";
    if (!file_exists($fichier)) {
        http_response_code(500);
        echo json_encode(['erreur' => 'Fichier introuvable']);
        exit;
    }

    $voyages = json_decode(file_get_contents($fichier), true);
    foreach ($voyages["voyages"] as $dest) {
        if ($dest["id"] == $id) {
            $base = $dest["prix"] * $dest["personnes"];
            $total = $base + $activite * 60 + $cantine * 40 + $arcade * 10;
            echo json_encode(['prix' => $total]);
            exit;
        }
    }

    http_response_code(404);
    echo json_encode(['erreur' => 'ID introuvable']);
    exit;
}

if (isset($_GET['ajax']) && $_GET['ajax'] === 'personnes' && isset($_GET['id'])) {
    header('Content-Type: application/json');

    $id = $_GET['id'];
    $fichier = "voyages.json";

    if (!file_exists($fichier)) {
        echo json_encode(['erreur' => 'Fichier introuvable']);
        exit;
    }

    $voyages = json_decode(file_get_contents($fichier), true);

    foreach ($voyages['voyages'] as $voyage) {
        if ($voyage['id'] == $id) {
            echo json_encode(['personnes' => $voyage['personnes']]);
            exit;
        }
    }

    echo json_encode(['erreur' => 'ID introuvable']);
    exit;
}
?>


<!DOCTYPE html>

<html>
    <head>

        <title>Fiche Détails</title>
        <script defer src="mode_sombre.js"></script>
        <link rel="stylesheet" href="style1.css" type="text/css">
        <link id="theme-link" rel="stylesheet" href="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="prix_total.js"></script>
    </head>

    <body>    
        <header>
            <div class="head">
                <ul>
                    <button id="toggle-mode">🌓</button>
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
                        <?php 
                            $connecte = isset($_SESSION['id']); 
                            if ($connecte){

                                $fichier = 'utilisateurs.json';

                                $contenu_fichier=file_get_contents($fichier);
                                $utilisateurs =json_decode($contenu_fichier, true); 

                                $tableau_utilisateur = $utilisateurs['utilisateurs'];

                                $utilisateurConnecte = null;

                                foreach($tableau_utilisateur as $uti){
                                    if ($uti['id'] == $_SESSION['id']){
                                        $utilisateurConnecte = $uti;
                                    }
                                }
                                echo "<a href='deconnexion.php?'>Deconnexion</a>
                                    <a href='Page_profil.php'>Mon Profil</a>";

                                if($utilisateurConnecte && $utilisateurConnecte['role'] === 'Administrateur'){
                                    echo "<a href='Page_admin.php'> Admin </a>";
                                }

                                echo "<div class='image_panier'>
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
                        echo "<p class='titre-details'><strong>".$dest["nom"]."</strong></p>";
                        echo "<div class='details' id='details'>";
                        echo "<center><img class='image' src='".$dest["image"]."'></center>";
                        echo "<p>";
                        echo "Lieu : ".$dest['destination']." <br>";
                        echo "Nombre de personnes : ".$dest['personnes']." personnes <br>";
                        echo "Prix/nuit : ".$dest['prix']."€ <br>";
                        echo "durée : ".$dest['duree']." jours <br>";
                        echo "Du ".$dest['debut']." au ".$dest['fin'];
                        echo "</p>";
                        $total_personnes = $dest['personnes'];
                        $prix =$dest['prix']*$dest['personnes'];
                    }
                }
                echo "<form action='ajouter_panier.php' method='post'>
                <p>Voici les options qu'on peut vous proposer :</p><br>
                <p>Menu activité (randonnée, laser game, karting, accrobranche) : +60€/personne</p>
                <div id=\"activite-bloc\"></div>

                <p>Cantine : +40€/personne</p>
                <div id=\"cantine-bloc\"></div>

                <p>Pass arcade : +10€/personne</p>
                <div id=\"arcade-bloc\"></div>

                <input type='hidden' name='id' value='$id'/>
                <br>
                <p>Prix total : </p>
                <p id='prix_total' data-extra='".$prix."'>".$prix."€</p>
                <div id='options-bloc' data-personnes='".$total_personnes."'></div>
                <button type='submit'>Ajouter au panier</button>
                </form>
                <div id='messagePanier' class='messagePanier'>
                        <strong>Le camping a été ajouté avec succès!!!</strong>
                        </div>
                </div>";


            }
        

        ?>    

        <script type="text/javascript">
            let select = document.querySelectorAll("select");
            for (let i = 0; i<select.length; i++){
                select[i].addEventListener("change", prix_total);
            }
            window.addEventListener("load", prix_total);
        </script>

            <?php if (isset($_GET['ajouter']) && $_GET['ajouter'] == 1): ?>
            <script>
                window.addEventListener("DOMContentLoaded", () => {
                    const notification = document.getElementById("messagePanier");
                    notification.classList.add("message");

                    setTimeout(() => {
                        notification.classList.remove("message");
                    }, 3000); 
                });
            </script>
        <?php endif; ?>

        <?php require 'footer.php';?>        


    </body>
</html>