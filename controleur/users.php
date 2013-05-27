<?php

// RESTful possibles : index, show, new, create, edit, update, destroy, 
// RESTful utilise : show, create

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
    
    case "search":
        if( isset($_POST['recherche'])){
    
            $resultats=  User::rechercher($_POST['recherche']);

            $vue='vue/users/resultat_recherche.php';
            require_once 'vue/index.php';
        }
        break;
    default:
        header("Location : index.php");
        break;
}
?>
