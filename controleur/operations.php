<?php

// RESTful possibles : index, show, new, create, edit, update, destroy, 
// RESTful utilise : index, create

if (!isset($_GET['action'])) {
    header("Location : index.php");
}

switch ($_GET['action']) {
    
    case "create":
        // On verifie si le receveur existe et si c'est un ami
        // On verifie si le solde est négatif ou pas
        // Cas d'un deal
        if (saisies::isDeal() && current_user::getSolde() > (int)$_POST['montant'] && $current_user::isFriend($_POST['receveur']))
            Operation::deal($_SESSION['id'],$_POST['receveur'],(int)$_POST['montant'], $_POST['libelle']);
        //On verifie que le montant (dans le cas d'un retrait) est inférieur au solde
        // Cas d'un transfert
        if (Saisies::isTransfert() && current_user::getSolde() > - (int)$_POST['montant'])
            Operation::isTransfert($_SESSION['id'],$_POST['montant'], $_POST['libelle']);
        
        
        
        header('Location: index.php');
        return;
        
    
    case "index":
        $operations = $current_user->getOperations();
        $vue='vue/operations/index.php';
        require_once 'vue/index.php';
        return;
    
    default:
        header("Location: index.php");
        return;
}
?>
