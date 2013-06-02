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
            
            //Sauvegarde dans la bdd
            $code=Registration::newRegistration($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['password']);
            
            // envoyer le mail
        } 
        break;
    case "save":
        
        if(!isset($_GET['id']) || !isset($_GET['code']) || (int)$_GET['id']==0){
            header("Location: index.php");
        }
        
        $data=  Registration::get($_GET['id']);
        
        if($data==null)
            header("Location: index.php");
        
        User::save($data['nom'],$data['prenom'],$data['mail'],$data['password']);
        
        Registration::erase($id);
        
        $flash="Inscription finalisée";
        require_once 'controleur/staticpages.php';
        return;
        
        break;
    default :
        header("Location: index.php");
        break;
}
?>
