<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $index = $_POST['index'];

        $fichier = 'utilisateurs.json';
        $contenu_fichier = file_get_contents($fichier);
        $tab_utilisateur = json_decode($contenu_fichier, true);


        $tab_utilisateur['utilisateurs'][$index]['role'] = 'VIP';


        $fichier_encode=json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
        file_put_contents($fichier,$fichier_encode );

        header("Location: Page_admin.php");
        exit();
    }
?>