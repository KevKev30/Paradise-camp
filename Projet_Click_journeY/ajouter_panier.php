<?php
    session_start();

    if (!isset($_SESSION['id'])) {
    echo "<script>alert('Veuillez vous connecter ou vous inscrire.'); window.location.href='connexion.php';</script>";
    exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $activite = ($_POST['activite']);
        $cantine = ($_POST['cantine']);
        $arcade = ($_POST['arcade']);

        $fichier = "voyages.json";
        if(file_exists($fichier)){
            $contenu_fichier = file_get_contents($fichier);
            $voyages = json_decode($contenu_fichier, true);
        }


        $voyageTrouve = null;

        foreach ($voyages['voyages'] as $voyage) {
            if ($voyage['id'] == $id) {
                $voyageTrouve = $voyage;
                break;
            }
        }

        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        foreach ($_SESSION['panier'] as $item) {
            if ($item['id'] == $id) {
                die("Ce voyage est déjà present dans votre panier");
                exit;
            }
        }

        $_SESSION['panier'][] = [
            'id' => $id,
            'nom' => $voyageTrouve['nom'],
            'destination' => $voyageTrouve['destination'],
            'hebergement' => $voyageTrouve['hebergement'],
            'image' => $voyageTrouve['image'],
            'personnes' => $voyageTrouve['personnes'],
            'prix_base' => $voyageTrouve['prix'],
            'debut' => $voyageTrouve['debut'],
            'fin' => $voyageTrouve['fin'],
            'duree' => $voyageTrouve['duree'],
            'activite' => $activite,
            'cantine' => $cantine,
            'arcade' => $arcade
        ];

        header("Location: details.php?id=$id&ajouter=1");
        exit;
    }
?>