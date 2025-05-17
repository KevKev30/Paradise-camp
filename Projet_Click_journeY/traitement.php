<?php
sleep(3); 

$traitement = json_decode(file_get_contents("php://input"), true);

if (isset($traitement['Id_utilisateur'], $traitement['action'])) {
    $Id_utilisateur = $traitement['Id_utilisateur'];
    $action = $traitement['action'];

    $contenu_fichier = file_get_contents('utilisateurs.json');
    $tab_utilisateur = json_decode($contenu_fichier, true);

    if ($action === 'promouvoir') {
        foreach ($tab_utilisateur['utilisateurs'] as &$utilisateur) {
            if ($utilisateur['id'] == $Id_utilisateur) {
                $utilisateur['role'] = 'VIP';
                break;
            }
        }
    }
    elseif ($action === 'bannir') {
        $nouvelle_liste = [];

        foreach ($tab_utilisateur['utilisateurs'] as $utilisateur) {
            if ($utilisateur['id'] != $Id_utilisateur) {
                $nouvelle_liste[] = $utilisateur;
            }
        }

        $tab_utilisateur['utilisateurs'] = $nouvelle_liste;
    }

    $fichier_encode = json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
    file_put_contents('utilisateurs.json', $fichier_encode);
    echo 'ok';
} else {
    http_response_code(400);
    echo 'Paramètres manquants';
}
