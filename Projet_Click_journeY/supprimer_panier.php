<?php
session_start();

if (isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['panier'][$index])) {
        unset($_SESSION['panier'][$index]);
        $_SESSION['panier'] = array_values($_SESSION['panier']); 
    }
}

header("Location: panier.php");
exit();
