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
    
    
        <form action="connexion.php" method="post">
            <fieldset>
                <p>Connectez-vous</p>
                <br>
        
                <div class="entete">
                    Identifiez-vous pour accéder à votre espace<br>personnel.
                </div>
                <br>
        
                <div class="caption">
                    Adresse mail  
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
                    <input type="submit" name="s'inscrire" value="Se Connecter" class="champ"/>
                </div>
                <br>
        
                <em>Pas encore de compte ? <a href="inscription.html">Inscription</a></em>
        
                <div class="charte">
                    <br>
                    En vous connectant, vous acceptez avoir <strong>lu</strong> 
                    <br>
                    et<strong> accepté</strong> les conditions générales
                    <br> 
                    et la charte de confidentialité.
                </div>
            </fieldset>
        </form>
    
        <div class="image_connexion"></div>

        <?php 
            session_start();

            if (isset($_POST['email']) && isset($_POST['password'])){
                $email = $_POST['email'];
                $password = $_POST['password']; 


                $fichier = 'utilisateurs.json';
                $contenu_fichier=file_get_contents($fichier);
            
                if(file_exists($fichier)){
                    $tab_utilisateur =json_decode($contenu_fichier, true);
            
            
                    foreach($tab_utilisateur['utilisateurs'] as $utilisateur){
                        if($utilisateur['email'] == $email){
                            if ($utilisateur['password']==$password){
                            header("Location: Page_accueil_connecte.php");
                            }
                            else{
                                echo ("Mot de passe incorect");
                            } 
                        }
                    }
                }
            }
        
        ?>


    
       <?php require 'footer.php'; ?>
        
    </body>
</html>