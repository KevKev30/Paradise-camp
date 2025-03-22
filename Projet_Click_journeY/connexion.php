<?php
    session_start();

    // Vérifie si l'utilisateur est déjà connecté
    if (isset($_SESSION['email'])) {
        header("Location: Page_profil.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];  
        $password = $_POST['password'];

        $fichier = 'utilisateurs.json';

        if (file_exists($fichier)) {
            
            $contenu_fichier = file_get_contents($fichier);
            $tab_utilisateur = json_decode($contenu_fichier, true);

            $utilisateurs = $tab_utilisateur["utilisateurs"];
            
            foreach ($tab_utilisateur['utilisateurs'] as $utilisateur) {
                if ($utilisateur['email'] == $email) {
                    if ($utilisateur['password'] == $password && $utilisateur['role'] == "Administrateur") { 
                        $_SESSION['email'] = $utilisateur['email'];   
                        header("Location: Page_admin.php");
                        exit;
                    } 
                    elseif ($utilisateur['password'] == $password && $utilisateur['role'] == "utilisateur" || $utilisateur['role'] == "VIP"){
                        $_SESSION['email'] = $utilisateur['email'];
                        header("Location: Page_profil.php");
                        exit;
                    }
                    else {
                        echo "<script>alert('Email ou mot de passe incorrect'); window.location.href='connexion.php';</script>";
                        exit;
                    }
                }
            }
            header("Location: inscription.php");
        }
    }
?>



<!DOCTYPE html>
<html>
    <head>
    
        <title>Connectez-vous</title>
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
                            <a href="connexion.php">Connexion</a>
                            <a href="inscription.php">Inscription</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    
        <fieldset>
            <p>Connectez-vous</p>
            <form action="connexion.php" method="POST">

            <br>
            
            <div class="entete">
                Identifiez-vous pour accéder à votre espace<br>personnel.
            </div>
            <br>
    
            <div class="caption">
                <label for="email">Adresse mail </label>  
            </div>
            <div class="zone">
                <input type="text" name="email" class="champ" placeholder="Saisissez votre email" required >
            </div>
            <br>
    
            <div class="caption">
                Mot de passe 
            </div>
            <div class="zone">
                <input type="password" name="password" class="champ" placeholder="Saisissez votre mot de passe" required >
            </div>
    
            <div class="underline"> Mot de passe oublié ?</div>
            <br>
    
            <div class="cliquer">
                <input type="submit" name="connexion" value="Se Connecter" class="champ"/>
            </div>
            <br>
    
            <em>Pas encore de compte ? <a href="inscription.php">Inscription</a></em>
    
            <div class="charte">
                <br>
                En vous connectant, vous acceptez avoir <strong>lu</strong> 
                <br>
                et<strong> accepté</strong> les conditions générales
                <br> 
                et la charte de confidentialité.
            </div>
            </form>
        </fieldset>
        
        <div class="image_connexion"></div>
    
       <?php require 'footer.php'; ?>
    </body>
</html>