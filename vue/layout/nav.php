<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($vue)){
    
    if(isset($_SESSION['id'])){
        
    ?>
    <div class='module'>
    <p class="nom"><?php echo $current_user->prenom.' '.$current_user->nom ?></p>
    <p class="email"><?php echo $current_user->email ?></p>
    <p class="solde"><?php echo 'Solde : '.$current_user->getSolde().' €' ?></p>
    </div>
    
    <div class='module'>
    <form action="index.php?page=operations&action=create&type=deal" method="post">
        <p class='formulaire_virement'>
            Virement express à
            <select id='receveur' name='receveur'>
                <option value='-1'> Choisir... </option>
                <?php foreach($current_user->getFriends() as $user) {
                    echo ("<option value='" . $user->id ."'>" . $user->prenom . " " . $user->nom . "</option>");
            }?></select>
            <input type='text' placeholder='0' size='3' id='montant' name="montant"> </input> € <br/>
            <input placeholder=' Libelle...' size='20' type='text' id='libelle' name="libelle"> </input>
           <input type="submit" id='valider' value="Donner">
           </p></form>
    <p> <a href='index.php?page=operations&action=new&type=load'> Recharger mon compte </a><br/>
    <a href='index.php?page=operations&action=new&type=back'> Retirer de l'argent </a></p>
    </div>
        
    
<?php
    }
    else echo 'Vous n\'êtes pas connecté';
            
}
else{
    header("Location: ../index.php");
}
?>
