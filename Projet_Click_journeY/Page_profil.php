<?php 
            session_start();

            if(isset($_SESSION['email'])){
                $uti = $_SESSION['email'];
            }

            $fichier = 'utilisateurs.json';
            $contenu_fichier = file_get_contents($fichier);
            $tab_utilisateur = json_decode($contenu_fichier, true);

                foreach ($tab_utilisateur['utilisateurs'] as $utilisateur) {
                    if ($utilisateur['email'] == $uti) {
                        $civilite = $utilisateur['civilite'];
                        $nom = $utilisateur['nom'];
                        $prenom = $utilisateur['prenom'];
                        $telephone = $utilisateur['telephone'];
                        $email = $utilisateur['email'];
                        $password = $utilisateur['password'];
                        break;
                    }
                }

            echo '<a href="deconnexion.php">Se déconnecter</a>';
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
                            <a href="connexion.php">Connexion</a>
                            <a href="inscription.php">Inscription</a>
                        </div> 
                    </div>
                </div>
            </div>
        </header>


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
                <?php 
                    echo "<input type='text' name='nom' placeholder='".$nom."' required />";
                ?>
                <button>Modifier</button>
            </div>
            <br/>

            <div class="caption">
                Prénom
            </div>
            <div class="zone">
                <?php
                    echo "<input type='text' name='prenom' placeholder='".$prenom."' required/>";
                ?>
                <button>Modifier</button>
            </div>
            <br/>

            <div class="caption">
                Téléphone
            </div>
            <div class="zone">
                <?php
                    echo "<input type='text' name='telephone' placeholder='".$telephone."' required/>";
                ?>
                <button>Modifier</button>
            </div>
            <br/>

            <div class="caption">
                Email 
            </div>
            <div class="zone">
                <?php
                    echo "<input type='text' name='email' placeholder='".$email."' required/>";
                ?>
                <button>Modifier</button>
            </div>
            <br/>

            <div class="caption_mdp">
                Mot de passe 
            </div>
            <div class="zone">
                <?php
                    echo "<input type='text' name='password' placeholder='".$password."' required/>";
                ?>
                <button>Modifier</button>
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
        <?php require 'footer.php'; ?>
    </body>
</html>