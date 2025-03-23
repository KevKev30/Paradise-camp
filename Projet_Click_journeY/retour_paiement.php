<?php
session_start();

if (isset($_GET['transaction']) && isset($_GET['montant']) && isset($_GET['vendeur']) && isset($_GET['statut']) && isset($_GET['control'])) {

    require 'getapikey.php';

    $transaction = $_GET['transaction'];
    $montant = $_GET['montant'];
    $vendeur = $_GET['vendeur'];
    $statut = $_GET['statut'];
    $control = $_GET['control'];


    $api_key = getAPIKey($vendeur); 


    $control_check = md5($transaction . "#" . $montant . "#" . $vendeur . "#" . $api_key);

    if ($control === $control_check) {

        if ($statut === "accepted") {
            echo "<h1>Paiement accepté</h1>";
            echo "<p>Votre paiement de " . $montant . "€ a été accepté pour la transaction : $transaction.</p>";
        } else {
            echo "<h1>Paiement refusé</h1>";
            echo "<p>Votre paiement a été refusé. Veuillez essayer à nouveau.</p>";
        }
    } else {

        echo "<h1>Erreur de validation</h1>";
        echo "<p>Les données de paiement ne sont pas valides. Veuillez contacter le support.</p>";
    }
} else {
    echo "<h1>Erreur de paramètres</h1>";
    echo "<p>Les paramètres de la transaction sont manquants. Veuillez réessayer.</p>";
}
?>