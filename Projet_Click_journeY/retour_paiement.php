<?php
session_start();
require 'getapikey.php';

if (isset($_GET['status'])) {
    $transaction = $_GET['transaction'];
    $montant = $_GET['montant'];
    $vendeur = $_GET['vendeur'];
    $status = $_GET['status'];
    $control = $_GET['control'];

    $api_key = getAPIKey($vendeur);
    $valeur_controle = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $status . "#");

    if ($control == $valeur_controle) {
        if ($status == 'accepted') {
            if (isset($_SESSION['reservation']) && isset($_SESSION['email'])){
                $fichier = 'utilisateurs.json';
                if(file_exists($fichier)){
                    $contenu_fichier = file_get_contents($fichier);
                    $utilisateurs = json_decode($contenu_fichier, true);
                }

                foreach($utilisateurs['utilisateurs'] as &$user){
                    if ($user["email"] == $_SESSION['email']){
                        $user["reservation"][] = $_SESSION['reservation'];
                    }
                }
                $fichier_encode=json_encode($utilisateurs, JSON_PRETTY_PRINT);
                file_put_contents($fichier,$fichier_encode);
                header("Location: Page_accueil.php");
                exit();
            }
        } else {
            echo "Le paiement a été refusé. Transaction ID : $transaction";
        }
    } else {
        echo "Erreur de validation des données.";
    }
}
?>