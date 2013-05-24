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
        
            
        //header('Location: index.php');
        break;
    default:
        header("Location : index.php");
        break;
}
?>
