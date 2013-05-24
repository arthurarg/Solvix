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

    <div class ='info_profil'>
        <p> <?php echo($current_user->prenom . ' ' . $current_user->nom); ?> </p>
        <p> <?php echo($current_user->email); ?> </p>
        <p> <?php echo($solde); ?> </p>
    </div>

    <div class ='dernieres_operations'>
        <?php 

        while($op = $taboperations->fetch()) {
            echo ('<p>' . $op['libelle'] . ' '. $op['montant'] . '</p>' );
        } 
        ?>
    </div>
<?php
}
else{ ?>
<div>
    Vous n'etes pas connecte !
</div>
<?php
} ?>