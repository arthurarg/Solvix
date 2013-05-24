<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($vue) && isset($_SESSION['id'])){
    ?>

    <p class="nom"><?php $current_user->prenom.' '.$current_user->nom ?></p>
    <p class="email"><?php $current_user->email ?></p>
    <p class="solde"><?php $current_user->getSolde() ?></p>
            
    
<?php
            
}
else{
    header("Location: ../index.php");
}
?>
