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
                    <li><a class="fa fa-arrow-circle-right" href="Page_presentation.html"> Présentation</a></li>
                    <li><a class="fa fa-map-o" href="Page_recherche.html"> Recherche</a></li>
                </ul>
                <div class="head1">
                    <h2> <a href="Page_accueil.html">Paradise camp</a></h2>
                </div>
                <p>Bienvenue sur Paradise Camp, le paradis grandeur nature</p>
          
                <div class="menu-connexion">
                    <div class="boutton">
                        <a class="fa fa-user-o"> Mon espace</a>
                        <div class="menu">
                            <a href="connexion.html">Connexion</a>
                            <a href="inscription.html">Inscription</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        
        <fieldset>
            <p>Inscrivez-vous</p>
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
                <select name="Civilité">
                    <option value="Femme">Mme</option>
                    <option value="Homme">M</option>
                </select>
            </div>
            <br/>
    
            <div class="caption">
                Nom
            </div>
            <div class="zone">
                <input type="text" name="nom" class="champ"/>
            </div>
            <br/>
    
            <div class="caption">
                Prénom
            </div>
            <div class="zone">
                <input type="text" name="email" class="champ"/>
            </div>
            <br/>
    
            <div class="caption">
                Email 
            </div>
            <div class="zone">
                <input type="text" name="email" class="champ" placeholder="Saisissez votre email" required />
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
                <input type="submit" name="s'inscrire" value="Créer mon compte" class="champ"/>
            </div>
            <br/>
    
            <em>Vous avez déjà un compte ? <a href="connexion.html">Connexion</a></em>
    
            <div class="charte">
                <br>
                En vous inscrivant, vous acceptez avoir <strong>lu</strong>
                <br>
                et <strong>accepté</strong> les conditions générales
                <br>
                et la charte de confidentialité.
            </div>
        </fieldset>


        <div class="image_inscription"></div>
        

        <?php                           
            if (isset($_POST['civilite']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password'])){
                $civilite = $_POST['civilite'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $password = $_POST['password']; 

                // Crée un tableau avec ces données
                $nouvel_utilisateur = [
                    "civilite" => $civilite,
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "email" => $email,
                    "password" => $password,
                    "date_inscription" => date("d.m.y")
                ];
                
                $fichier = 'utilisateurs.json';
                $contenu_fichier=file_get_contents($fichier);
                
                // verifie si le fichier existe
                if(file_exists($fichier)){
                    $tab_utilisateur =json_decode($contenu_fichier, true);
                
                
                    foreach($tab_utilisateur['utilisateurs'] as $utilisateur){
                        if($utilisateur['email'] == $email && $utilisateur['password']==$password){
                            echo "Vous êtes déjà inscrit veuillez vous connecter";
                            //header("Location : connexion.php");
                            exit;
                        }
                    }
                    // Ajoute le nouvel utilisateur
                    $tab_utilisateur[] = $nouvel_utilisateur;
                    $fichier_encode=json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
                    // Enregistre les données dans le fichier JSON
                    file_put_contents($fichier,$fichier_encode );

                }
            }
        ?>    
        <?php require 'footer.php'; ?>

    </body>
</html>