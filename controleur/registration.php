<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!isset($_GET['action'])) {
    header("Location: index.php");
}

switch ($_GET['action']) {
    case "new":
        if (Saisies::isInscriptionValide() && User::exists($_POST['mail'])==false && Registration::exists($_POST['mail'])==false) {
            echo'ty';
            //Sauvegarde dans la bdd
            $code=Registration::newRegistration($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['password']);
            $id=Registration::exists($_POST['mail']);
            // envoyer le maile
            header("Location: helper/messages.php?code=$code&id=$id");
        }
        else{
            $flash="Inscription impossible";
            $redirection=true;
            require_once 'controleur/staticpages.php';
        }
        break;
    case "save":
        
        if(!isset($_GET['id']) || !isset($_GET['code']) || (int)$_GET['id']==0){
            header("Location: index.php");
        }
        
        $data=  Registration::get($_GET['id']);
        
        if($data==null)
            header("Location: index.php");
        
        User::saveCrypted($data['nom'],$data['prenom'],$data['email'],$data['password'], true);
        
        Registration::erase($data['id']);
        
        $flash="Inscription finalisée";
        $redirection=true;
        require_once 'controleur/staticpages.php';
        return;
        
        break;
    default :
        header("Location: index.php");
        break;
}
?>
