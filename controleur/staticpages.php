<?php

if (!isset($_GET['page']) || $_GET['page'] == 'home') {
    
    if (isset($_SESSION['id'])) {
        $user = new User($_SESSION['id']);
        $solde = $user->getSolde();
        $taboperations = $user->getLastOperations();
        $tabamis=$user->getFriends();
    }
    
    require_once 'vue/staticpages/home.php';
    return;
}

if ($_GET['page'] == 'erreur') {
    require_once 'vue/staticpages/erreur.php';
    return;
}
?>
