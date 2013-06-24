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
    <p> Dernière connexion : <?php echo $user_showed->last_connect ?></p>
    
    <button type='button' class='button_user_1'><a href="index.php?page=operations&action=new&type=deal&id=<?php echo $user_showed->id ?>"> Virement</a></button>
    <br/>
    <?php if ($user_showed->estAmi) { ?>
    <button type='button' class='button_user_2'><a class="confirmation" value="<?php echo $user_showed->id ?>">Supprimer cet ami</a></button>
    <?php } ?>
    
    <div class="dernieres_operations">
        <p> Dernieres operations en commun </p>
        <?php Affichage::afficher_operations($taboperations);?>
        <button type='button' class='button_home' onclick="location.replace('index.php?page=operationss&action=index')">
            Voir toutes mes opérations
        </button>
    </div>

    <div class="quelques_amis">
        <p> Amis de cette personne </p>
        <?php Affichage::afficher_users($tabamis);?>
        <button type='button' class='button_home' onclick="location.replace('index.php?page=users&action=index')">
            Voir tous mes amis
        </button>
    </div>
    <?php
}
?>