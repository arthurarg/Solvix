<?php

if (!isset($_GET['page']) || $_GET['page'] == 'home') {
    
    if (isset($_SESSION['id'])) {
        $solde = $current_user->getSolde();
        $taboperations = $current_user->getLastOperations();
        $tabamis=$current_user->getFriends();
    }
    
    $vue='vue/staticpages/home.php';
    require_once 'vue/index.php';
    return;
}

if ($_GET['page'] == 'erreur') {
    $vue='vue/staticpages/erreur.php';
    require_once 'vue/index.php';
    return;
}
?>
