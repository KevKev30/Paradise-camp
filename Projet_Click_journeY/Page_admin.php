<!DOCTYPE html>
<html>
    <head>
    
        <title>Administrateur</title>
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

        <div class="admin">
            <p>Bonjour, Voici les personnes inscrits dans le site :</p>
        </div>


        <table cellpadding="5" border="3" cellspacing="5">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>e-mail</th>
                <th>Gestion</th>
            </tr>
            <tr>
                <td>Buzel</td>
                <td>Mathis</td>
                <td>mat.buz@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>       
            <tr>
                <td>Buz</td>
                <td>Alex</td>
                <td>zenn.alex@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>
            <tr>
                <td>Coubisisa</td>
                <td>Tony</td>
                <td>thephoenix18@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>      
            <tr>
                <td>Ramad</td>
                <td>Ari</td>
                <td>mhd450@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>       
            <tr>
                <td>Vabriss</td>
                <td>Oumar</td>
                <td>filsdusoleil.sherlock@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>
            <tr>
                <td>Mastu</td>
                <td>Théo</td>
                <td>contact@mastucorp.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>   
            <tr>
                <td>Jardine</td>
                <td>John</td>
                <td>jean.dujar@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>       
            <tr>
                <td>Morujene</td>
                <td>Melison</td>
                <td>poupette92@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>
            <tr>
                <td>Bazo</td>
                <td>Kalina</td>
                <td>kaatsup.collab@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>   
            <tr>
                <td>Barry</td>
                <td>Gertrude</td>
                <td>madame.barry95312@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>       
            <tr>
                <td>LeBron</td>
                <td>James</td>
                <td>LeGoat.hY23616@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>
            <tr>
                <td>Micaj</td>
                <td>Jojo</td>
                <td>steph30.guez@gmail.com</td>
                <td>
                    <button type="submit" class="vip">Promouvoir</button>
                    <button type="submit" class="ban">Bannir</button>
                </td>
            </tr>     
        </table>


      
        <?php require 'footer.php';?>
        
    </body>
</html>