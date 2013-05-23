<?php

// RESTful possibles : index, show, new, create, edit, update, destroy, 
// RESTful utilise : 

if (!isset($_GET['action'])) {
    header("Location : index.php");
}

switch ($_GET['action']) {
    
    case "show":
        if (isset($_SESSION['id'])) {
            $user = new User($_SESSION['id']);
            $solde = $user->getSolde();
            $taboperations = $user->getLastOperations();
            $tabamis=$user->getFriends();
        }
        $show=true;
        $vue='vue/users/show.php';
        require_once 'vue/index.php';
        break;
    
    default:
        header("Location : index.php");
        break;
}
?>
