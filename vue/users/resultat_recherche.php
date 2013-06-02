<?php
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}

if (isset($_SESSION['id'])) { 
    
    if($resultats!=0){
        echo("<div> Résultat(s) de la recherche </div><br/>");
        Affichage::afficher_users($resultats);
    }
    else echo 'Aucun résultat<br/>';
}
else{ ?>
<div>
    Vous n'etes pas connecte !
</div>
<?php
} ?>

