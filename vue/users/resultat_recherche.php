<?php
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}

if (isset($_SESSION['id'])) { 
    
    if($resultats!=0){
        Affichage::afficher_users($resultats);
    }
    else echo 'aucun résultat<br/>';
}
else{ ?>
<div>
    Vous n'etes pas connecte !
</div>
<?php
} ?>

