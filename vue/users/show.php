<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}
    

if (isset($_SESSION['id'])) { ?>
    
    <p class="nom"><?php echo $user_showed->prenom.' '.$user_showed->nom ?></p>
    <p class="email"><?php echo $user_showed->email ?></p>
    <p><a href="index.php?page=operations&action=new&type=deal&id=<?php echo $user_showed->id ?>"> Effectuer un virement à cette personne</a></p>
    
    <?php if ($user_showed->estAmi) { ?>
    <p><a class="confirmation" value="<?php echo $user_showed->id ?>">Ne plus être amis avec cette personne</a></p>
    <?php } ?>
    
    <div class="dernieres_operations">
        <p> Dernieres operations en commun </p>
        <?php Affichage::afficher_operations($taboperations);?>
    </div>
    <a href='index.php?page=operations&action=index'> Voir toutes mes opérations </a>

    <div class="quelques_amis">
        <p> Amis de cette personne </p>
        <?php Affichage::afficher_users($tabamis);?>
    </div>
    <a href='index.php?page=users&action=index'> Voir tous mes amis </a>
    <?php
}
?>