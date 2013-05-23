<?php

// RESTful possibles : index, show, new, create, edit, update, destroy, 
// RESTful utilise : index, create

if (!isset($_GET['action'])) {
    header("Location : index.php");
}

switch ($_GET['action']) {
    
    case "create":
        //Pour l'instant, on ne verifie pas si le receveur existe et si c'est un ami
        // On ne verifie pas non plus si le solde est négatif ou pas
        // Cas d'un deal
        if (saisies::isDeal())
            Operation::deal($_SESSION['id'],$_POST['receveur'],(int)$_POST['montant'], $_POST['libelle']);
        // Cas d'un transfert
        if (Saisies::isTransfert())
            Operation::isTransfert($_SESSION['id'],$_POST['montant'], $_POST['libelle']);
        
        header('Location: index.php');
        return;
        
    
    case "index":
        $operations = Operation::getMyOperation();
        $vue='vue/operations/index.php';
        require_once 'vue/index.php'; // ???????????
        return;
    
    default:
        header("Location: index.php");
        return;
}
?>
