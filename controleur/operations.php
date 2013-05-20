<?php

// RESTful possibles : index, show, new, create, edit, update, destroy, 
// RESTful utilise : index, create

if (!isset($_GET['action'])) {
    header("Location : index.php");
}

switch ($_GET['action']) {
    
    case "create":
        // Cas d'un deal
        if (Saisies::isDeal())
            Operation::deal($_SESSION['id'],$_POST['receveur'],$_POST['montant'], $_POST['libelle']);
        // Cas d'un transfert
        if (Saisies::isTransfert())
            Operation::isTransfert($_SESSION['id'],$_POST['montant'], $_POST['libelle']);
        
        header('Location : index.php');
        break;
        
    
    case "index":
        $operations = Operation::getMyOperation();
        require_once 'vue/operations/index.php'; // ???????????
        break;
    
    default:
        header("Location : index.php");
        break;
}
?>
