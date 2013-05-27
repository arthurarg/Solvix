<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($vue)){
    
    if(isset($_SESSION['id'])){
        
    ?>

    <p class="nom"><?php echo $current_user->prenom.' '.$current_user->nom ?></p>
    <p class="email"><?php echo $current_user->email ?></p>
    <p class="solde"><?php echo $current_user->getSolde() ?></p>
            
    
<?php
    }
    else echo 'Vous n\'êtes pas connecté';
            
}
else{
    header("Location: ../index.php");
}
?>
