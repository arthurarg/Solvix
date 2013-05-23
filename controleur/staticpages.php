<?php

if (!isset($_GET['page']) || $_GET['page'] == 'home') {
    
    if (isset($_SESSION['id'])) {
        $user = new User($_SESSION['id']);
        $solde = $user->getSolde();
        $taboperations = $user->getLastOperations();
        $tabamis=$user->getFriends();
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
