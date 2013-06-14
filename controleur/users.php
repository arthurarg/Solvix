<?php

// RESTful possibles : index, show, new, create, edit, update, destroy, 
// RESTful utilise : show, create

if (!isset($_GET['action'])) {
    header("Location: index.php");
}

switch ($_GET['action']) {
    
    case "show":
        if (!isset($_GET['id']) || $_GET['id']==$current_user->id || ! User::isUser($_GET['id']))
                header('Location: index.php');
        
        $user_showed = new User($_GET['id']);
        $taboperations = $user_showed->getCommonOperations($current_user);
        $tabamis=$user_showed->getSomeFriends();
        
        $vue='vue/users/show.php';
        require_once 'vue/index.php';
        break;
    
    case "create":
        if (Saisies::isInscriptionValide() && User::exists($_POST['mail'])==false) {
            //Sauvegarde dans la bdd
            User::save($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['password']);
            //Connection du nouvel utilisateur
            $id = User::exists($_POST['mail']);
            if ($id != null)
                $_SESSION['id'] = $id;
        } 
        header('Location: index.php');
        break;
    
    case "index":
        $amis=$current_user->getFriends();
        $vue='vue/users/index.php';
        require_once 'vue/index.php';
        break;
    
    case "edit":
        $vue='vue/users/edit.php';
        require_once 'vue/index.php';
        break;
    
    case "update":
        if (Saisies::isValidUpdate() && User::verifierMotdePasse($current_user->email, $_POST['password'])) {
            if (isset($_POST['new_password'])) 
                User::update_password($_POST['new_password']);
            else if (isset($_POST['iban']))
                User::update_iban($_POST['iban']);
            $flash = "Mise à jour reussie";
        }
        else
            $flash = "Mise à jour : échec ";
        
        $vue = "index.php";
        require_once 'vue/index.php';
        break;       
    

    case "search":
        if( isset($_POST['recherche'])){
    
            $resultats=  User::rechercher($_POST['recherche']);
            
            if(isset($_GET['type']) && $_GET['type']=="dynamic"){
                $vue='vue/users/resultat_recherche.php';
                require_once $vue;
            }
            else{
            
                $vue='vue/users/resultat_recherche.php';
                require_once 'vue/index.php';
                
            }
        }
        break;
        
    default:
        header("Location : index.php");
        break;
}
?>
