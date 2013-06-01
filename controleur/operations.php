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
            switch ($_GET['type']){
                case "deal":
                    if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>=0 && $current_user->isFriend($_GET['id'])){
                        $id=$_GET['id'];
                    }else{
                        // méthode copié dans case=create
                        $amis=$current_user->getFriends();
                        if(strlen($amis==0)){
                            $flash="Vous n'avez pas d'ami à qui faire un virement";
                            $redirection=true;
                            require_once 'controleur/staticpages.php';
                            return;
                        }
                    }
                    
                    $vue='vue/operations/new_deal.php';
                    break;
                case "transfer":
                    $vue='vue/operations/new_transfer.php';
                    break;
                default:
                    $flash="Action interdite";
                    $redirection=true;
                    require_once 'controleur/staticpages.php';
                    return;
                    break;
            }
            
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
                    if(Saisies::isDealSafe() && ( $current_user->isFriend($_POST['receveur']) || $_POST['receveur']==-1 ) ){
                        if($solde<$_POST['montant']){
                            $flash="Provisions insuffisantes";
                            
                            $id=$_POST['receveur'];                            
                            $vue='vue/operations/new_deal.php';
                            
                            require_once 'vue/index.php';
                            return;
                        }
                        else if($_POST['receveur']==-1){
                            $flash="Veuillez choisir un bénéficiaire";
                            
                            // methode copiee à partir de case = new
                            $amis=$current_user->getFriends();
                            if(strlen($amis==0)){
                                $flash="Vous n'avez pas d'ami à qui faire un virement";
                                $redirection=true;
                                require_once 'controleur/staticpages.php';
                                return;
                            }
                            $vue='vue/operations/new_deal.php';
                            
                            require_once 'vue/index.php';
                            return;
                        }
                        else{
                            Operation::deal($_SESSION['id'],$_POST['receveur'],$_POST['montant'], $_POST['libelle']);
                            $flash="Virement effectué";
                        }
                    }
                    else
                        $flash="Virement impossible";
                    
                    break;
                case "transfer":
                    
                    if (Saisies::isTransfert() && $current_user->getSolde() > - $_POST['montant']){
                        Operation::transfer($_SESSION['id'],$_POST['montant'], $_POST['libelle']);
                        $flash="Transfert réussi";
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
