<?php 

    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $civilite = $_POST['civilite'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password']; 


        $nouvel_utilisateur = [
            "civilite" => $civilite,
            "role" => 'utilisateur',
            "nom" => $nom,
            "prenom" => $prenom,
            "telephone"=> NULL,
            "email" => $email,
            "password" => $password,
            "date_inscription" => date("d.m.y"),
            "reservation" => []
        ];

        $fichier = 'utilisateurs.json';



        if(file_exists($fichier)){
            $contenu_fichier=file_get_contents($fichier);   
            $tab_utilisateur =json_decode($contenu_fichier, true);                 

            foreach($tab_utilisateur['utilisateurs'] as $utilisateur){
                if($utilisateur['email'] == $email && $utilisateur['password']==$password){
                    header("Location: connexion.php");
                    exit;
                }
            }

            $tab_utilisateur['utilisateurs'][] = $nouvel_utilisateur;

            $fichier_encode=json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
            file_put_contents($fichier,$fichier_encode );

            header("Location: Page_profil.php");

        }
    }
?>

<!DOCTYPE html>
<html>
    <head>

        <title>Inscrivez-vous</title>
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
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature</p>

                <div class="menu-connexion">
                    <div class="boutton">
                        <a class="fa fa-user-o"> Mon espace</a>
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

        <fieldset>
            <p>Inscrivez-vous</p>
            <form action="inscription.php" method="POST">
            <div class="entete">
                Inscrivez-vous pour profiter d'une meilleur experience <br>en tant que membre.
                <br>
                <br>
                <br>
            </div>

            <div class="caption">
                Civilité
            </div>

            <div class="zone">
                <select name="civilite">
                    <option value="Femme">Mme</option>
                    <option value="Homme">M</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            <br/>

            <div class="caption">
                Nom
            </div>
            <div class="zone">
                <input type="text" name="nom" required/>
            </div>
            <br/>

            <div class="caption">
                Prénom
            </div>
            <div class="zone">
                <input type="text" name="prenom" required/>
            </div>
            <br/>

            <div class="caption">
                Email 
            </div>
            <div class="zone">
                <input type="text" name="email" placeholder="Saisissez votre email" required />
            </div>
            <br/>

            <div class="caption_mdp">
                 Mot de passe 
            </div>
            <div class="zone">
                <input type="password" name="password" class="champ" placeholder="Saisissez votre mot de passe" required />
            </div>
            <br/>

            <div class="cliquer">
                <input type="submit" name="inscrire" value="Créer mon compte"/>
            </div>
            <br/>

            <em>Vous avez déjà un compte ? <a href="connexion.php">Connexion</a></em>

            <div class="charte">
                <br>
                En vous inscrivant, vous acceptez avoir <strong>lu</strong>
                <br>
                et <strong>accepté</strong> les conditions générales
                <br>
                et la charte de confidentialité.
            </div>
    </form>
        </fieldset>

        <div class="image_inscription"></div>


    <?php require 'footer.php'; ?>

    </body>
</html>