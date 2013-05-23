<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue)){
    echo "Vous n'avez pas accès à la page";
    return;
}
    

if (isset($_SESSION['id'])) { ?>

    <div class ='info_profil'>
        <p> <?php echo($_SESSION['prenom'] . ' ' . $_SESSION['nom']); ?> </p>
        <p> <?php echo($_SESSION['email']); ?> </p>
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
    Vous n'êtes pas connecté !
</div>
<?php
} ?>