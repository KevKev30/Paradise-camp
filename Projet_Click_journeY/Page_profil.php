<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>

        <title>Mon Profil</title>
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
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature.</p>

                <div class="menu-connexion">
                    <div class="boutton">
                        <a class="fa fa-user-o"> Mon espace</a>
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

        <?php 

            $uti = $_SESSION['id'];
            $fichier = 'utilisateurs.json';
            $nom = $prenom = $telephone = $email = $password = $civilite = "";

            if (file_exists($fichier)){
                $contenu_fichier = file_get_contents($fichier);
                $tab_utilisateur = json_decode($contenu_fichier, true);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $civilite = $_POST['civilite'];
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $telephone = $_POST['telephone'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                
                    foreach ($tab_utilisateur['utilisateurs'] as &$utilisateur) {
                        if ($utilisateur['id'] == $uti) {
                            $utilisateur['civilite'] = $civilite;
                            $utilisateur['nom'] = $nom;
                            $utilisateur['prenom'] = $prenom;
                            $utilisateur['telephone'] = $telephone;
                            $utilisateur['email'] = $email;
                            $utilisateur['password'] = $password;
                            break;
                        }
                    }

                    $fichier_encode = json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
                    file_put_contents($fichier, $fichier_encode);
                }

                foreach ($tab_utilisateur['utilisateurs'] as $utilisateur) {
                    if ($utilisateur['id'] == $uti) {
                        $civilite = $utilisateur['civilite'];
                        $nom = $utilisateur['nom'];
                        $prenom = $utilisateur['prenom'];
                        $telephone = $utilisateur['telephone'];
                        $email = $utilisateur['email'];
                        $password = $utilisateur['password'];
                        break;
                    }
                }
            }
            
        ?>
    
        <fieldset>
            <p>Mon Profil</p>
            
            <div class="entete">
                Verifiez vos informations et modifiez les si besoins
            </div>
            <br>
            <br>
            <form action="Page_profil.php" method="POST">
            <div class="caption">
                Civilité
            </div>
            <div class="zone">
                <select name="civilite">
                    <?php 
                        if ($civilite == "Homme"){
                            echo "<option value='Homme'>Homme</option>";
                        }
                        elseif ($civilite == "Femme"){
                            echo "<option value='Femme'>Femme</option>";
                        }
                        else{
                            echo "<option value='Autre'>Autre</option>";
                        }
                    ?>
                </select>
            </div>
            <br/>

            <div class="caption">
                Nom 
            </div>
            <div class="zone">
                <input type="text" name="nom" value="<?php echo $nom; ?>" readonly>
                <button type="button" onclick="modifNom(this);">Modifier</button>
            </div>
            <br/>

            <div class="caption">
                Prénom
            </div>
            <div class="zone">
                <input type="text" name="prenom" value="<?php echo $prenom; ?>" readonly>
                <button type="button" onclick="modifPrenom(this);">Modifier</button>
            </div>
            <br/>

            <div class="caption">
                Téléphone
            </div>
            <div class="zone">
                <input type="text" name="telephone" value="<?php echo $telephone; ?>" readonly>
                <button type="button" onclick="modifTelephone(this);">Modifier</button>
            </div>
            <br/>

            <div class="caption">
                Email 
            </div>
            <div class="zone">
                <input type="text" name="email" value="<?php echo $email; ?>" readonly>
                <button type="button" onclick="modifEmail(this);">Modifier</button>
            </div>
            <br/>

            <div class="caption_mdp">
                Mot de passe 
            </div>
            <div class="zone">
                <input type="text" name="password" value="<?php echo $password; ?>" readonly>
                <button type="button" onclick="modifMdp(this);">Modifier</button>
            </div>
            <br/>

            <div class="cliquer">
                <input type="submit" name="s'inscrire" value="Enregister" class="champ"/>
            </div>
            <br/>

            <div class="charte">
                <br>
                Vos données ont été collectées lors de la création de votre compte client et de vos voyages en ligne. 
                <br>Vous pouvez les modifier directement sur cette page.<br> 
                Ces informations et celles de vos voyages sont traitées par<strong> Paradise Camp</strong> principalement pour gérer
                 <br>votre compte, personnaliser vos services et gérer vos voyages
                 <br>(y compris pour la prévention de la fraude) mesurer votre satisfaction et faire du marketing ciblé (profilage publicitaire).
            </div>
            </form>
        </fieldset>
        <div class="image_inscription"></div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <h1><center>Mes réservations :</center></h1>
            <?php 
                foreach ($tab_utilisateur['utilisateurs'] as &$utilisateur) {
                    if ($utilisateur['id'] == $uti) {
                        if ($utilisateur['reservation'] == []){
                            echo "<h1><center>Pas de réservations.</center></h1>";
                        }
                        else{
                            foreach($utilisateur['reservation'] as $res){
                                echo "<div class='selection1'>";
                                echo "<img class='photo' src='" . $res['image'] . "'>";
                                echo $res['nom'] . " - " . $res['destination'] . "<br>";
                                echo $res['hebergement'] . " ". $res['personnes'] . " personnes";
                                echo "<br> Prix Total:".  $res['prix'] . "€<br>";
                                echo "Durée :". $res['duree']. "jours
                                <br>
                                Option :
                                <br>";
                                if ($res['option']["activite"] != 0 || $res["option"]["cantine"] != 0 || $res["option"]["arcade"] != 0){
                                    if ($res["option"]["activite"] != 0){
                                        echo "Menu Activité : " . $res["option"]["activite"] . " personnes <br>";
                                    }
                                    if ($res["cantine"] != 0){
                                        echo "Cantine : " . $res["option"]["cantine"] . " personnes <br>";
                                    }
                                    if ($res["option"]["arcade"] != 0){
                                        echo "Pass arcade : " . $res["option"]["arcade"] . " personnes <br>";
                                    }
                                }
                                else{
                                    echo "Sans options";
                                }
                                echo "</p>";
                                echo "</div>";
                            }
                        }
                    }
                }
            ?>


        <?php require 'footer.php';?>
        <script src="client.js"></script>
    </body>
</html>