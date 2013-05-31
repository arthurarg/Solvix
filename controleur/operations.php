<?php

// RESTful possibles : index, show, new, create, edit, update, destroy, 
// RESTful utilise : index, create

if (!isset($_GET['action'])) {
    header("Location : index.php");
}

switch ($_GET['action']) {
    
    case "new":
        if(!isset($_GET['type'])){
            $flash="Action interdite";
            $redirection=true;
            require_once 'controleur/staticpages.php';
        }
        else{
            $vue='vue/operations/new.php';
            require_once 'vue/index.php';
        }
        return;
    
    case "create":
        
        if(!isset($_GET['type']))
            $flash="Action interdite";
        else{
            
            switch($_GET['type']){
                case "deal":
                    $solde=$current_user->getSolde();
                    if (saisies::isDeal() &&  $solde >= $_POST['montant'] && $current_user->isFriend($_POST['receveur'])){
                        Operation::deal($_SESSION['id'],$_POST['receveur'],$_POST['montant'], $_POST['libelle']);
                        $flash="Virement effectué";
                    }
                    else{
                        if($solde<$_POST['montant'])
                            $flash="Provisions insuffisantes";
                        else
                            $flash="Virement impossible";
                    }
                    
                    break;
                case "transfer":
                    
                    if (Saisies::isTransfert() && $current_user->getSolde() > - $_POST['montant']){
                        Operation::transfer($_SESSION['id'],$_POST['montant'], $_POST['libelle']);
                        $flash="Transfert réussit";
                    }
                    else
                        $flash="Transfert impossible";
                    break;
                default:
                    $flash="Action interdite";
                    break;
            }
            
        }
        $redirection=true;
        require_once 'controleur/staticpages.php';
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
