<?php


if (!isset($_GET['action'])) {
    header("Location : index.php");
}

switch ($_GET['action']) {
    
    case "create":
        global $current_user;
        if (Saisies::isRelationship() && User::isUser($_GET['id']) && !$current_user->isFriend($_GET['id']))
            Relationship::save($_SESSION['id'],$_GET['id']);
        
        $flash="Ami ajouté !";
        $redirection = true;
        require_once 'controleur/staticpages.php';
        break;
    
    case "destroy":
        if (Saisies::isRelationship())
            Relationship::delete($current_user->id, $_GET['id']);
        
        header('Location: index.php');
        break;
        
    
    case "index":
     
        break;
    
    default:
        header("Location : index.php");
        break;
}
?>
