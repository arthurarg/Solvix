<?php

if (!isset($_GET['page']) || $_GET['page'] == 'home' || isset($redirection)) {
    
    if (isset($_SESSION['id'])) {
        $solde = $current_user->getSolde();
        $taboperations = $current_user->getLastOperations();
        $tabamis=$current_user->getSomeFriends();
        
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
