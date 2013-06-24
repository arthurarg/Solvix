<?php


if (!isset($_GET['action'])) {
    header("Location: index.php");
}

switch ($_GET['action']) {
    
    case "validate":
        if (!isset($_GET['asw']) || (($_GET['asw']!="y" AND $_GET['asw']!="n")) || !isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id']<0) {
            header("Location: index.php");
        }
        $resultat=Operation::validate($_GET['asw'], $_GET['id'], $current_user);
        if($resultat=="true"){
            if($_GET['asw']=="y")
                $flash="Virement effectué";

            if(isset($_GET['da']) && $_GET['da']>0 && is_numeric($_GET['da'])){
                Alert::erase($_GET['da'], $current_user->id);
            }
            header("Location: index.php");
        }
        else{
            $redirection=true;
            $flash=$resultat;
            require_once 'controleur/staticpages.php';
            return;
        }
        
        break;
        
    
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
                    require_once 'vue/index.php';
                    break;
                case "query":
                    if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>=0 && $current_user->isFriend($_GET['id'])){
                        $id=$_GET['id'];
                    }else{
                        // méthode copié dans case=create
                        $amis=$current_user->getFriends();
                        if(strlen($amis==0)){
                            $flash="Vous n'avez pas d'ami avec qui réaliser cette opération";
                            $redirection=true;
                            require_once 'controleur/staticpages.php';
                            return;
                        }
                    }
                    
                    $vue='vue/operations/new_query.php';
                    require_once 'vue/index.php';
                    break;
                    
                case "load":
                    $vue='vue/operations/new_load.php';
                    require_once 'vue/index.php';
                    break;
                case "back":
                    $vue='vue/operations/new_back.php';
                    require_once 'vue/index.php';
                    break;
                default:
                    $flash="Action interdite";
                    $redirection=true;
                    require_once 'controleur/staticpages.php';
                    break;
            }            
        }
        break;
    
    case "create":
        
        if(!isset($_GET['type']))
            $flash="Action interdite";
        else{
            
            switch($_GET['type']){
                case "deal":
                    $solde=$current_user->getSolde();
                    if(Saisies::isDealSafe() && ((User::isUser($_POST['receveur']) &&$current_user->isFriend($_POST['receveur'])) || $_POST['receveur']==-1 ) ){
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
                 case "query":
                     /* attention ici $_POST['receveur'] correspond à l'emetteur */
                     $emetteur=new User($_POST['receveur']);
                    if(Saisies::isDealSafe() && ($current_user->isFriend($emetteur->id) && $emetteur->isFriend($current_user->id) || $_POST['receveur']==-1 ) ){
                        if($_POST['receveur']==-1){
                            $flash="Veuillez choisir quelqu'un";
                            
                            // methode copiee à partir de case = new
                            $amis=$current_user->getFriends();
                            if(strlen($amis==0)){
                                $flash="Vous n'avez pas d'ami à qui demander un virement";
                                $redirection=true;
                                require_once 'controleur/staticpages.php';
                                return;
                            }
                            $vue='vue/operations/new_query.php';
                            
                            require_once 'vue/index.php';
                            return;
                        }
                        else{
                            Operation::ask_deal($_POST['receveur'], $_SESSION['id'],$_POST['montant'], $_POST['libelle']);
                            $flash="Requète envoyée à $emetteur->prenom $emetteur->nom";
                        }
                    }
                    else
                        $flash="Virement impossible";
                    
                    break;
                case "load":
                    
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
                    
                case "back":
                    
                    if (Saisies::isTransfert() && $current_user->getSolde() > - $_POST['montant'] && !empty($current_user->iban)){
                        Operation::transfer($_SESSION['id'],-$_POST['montant'], $_POST['libelle']);
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
