<?php

if (!isset($_GET['page']) || $_GET['page'] == 'home') {
    
    if (isset($_SESSION['id'])) {
        
    }
    
    
    require_once 'vue/staticpages/home.php';
    return;
}

if ($_GET['page'] == 'erreur') {
    require_once 'vue/staticpages/erreur.php';
    return;
}
?>
