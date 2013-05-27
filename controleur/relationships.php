<?php

// RESTful possibles : index, show, new, create, edit, update, destroy, 
// RESTful utilise : create, destroy, index

if (!isset($_GET['action'])) {
    header("Location : index.php");
}

switch ($_GET['action']) {
    
    case "create":
        if (Saisies::isRelationship() && User::isUser($_GET['id']))
            Relationship::save($_GET['id']);
    
        header('Location : index.php');
        break;
    
    case "destroy":
        if (Saisies::isRelationship())
            Relationship::delete($_GET['id']);
    
        header('Location : index.php');
        break;
        
    
    case "index":
     
        break;
    
    default:
        header("Location : index.php");
        break;
}
?>
