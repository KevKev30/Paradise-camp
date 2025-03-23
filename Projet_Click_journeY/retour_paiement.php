<?php
if (isset($_GET['status'])) {
    $transaction = $_GET['transaction'];
    $montant = $_GET['montant'];
    $vendeur = $_GET['vendeur'];
    $status = $_GET['status'];
    $control = $_GET['control'];

    // Vérifier la validité de la valeur de contrôle
    $vendeur = 'MI-3_J';
    $api_key = getAPIKey($vendeur);
    $valeur_controle = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $status . "#");

    if ($control == $valeur_controle) {
        if ($status == 'accepted') {
            echo "Le paiement a été accepté. Transaction ID : $transaction";
        } else {
            echo "Le paiement a été refusé. Transaction ID : $transaction";
        }
    } else {
        echo "Erreur de validation des données.";
    }
}
?>