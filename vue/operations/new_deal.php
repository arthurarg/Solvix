<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}
if(isset($_GET['type']) && $_GET['type']=="deal"){
        ?>

<form action='index.php?page=operations&action=create&type=deal' method='POST'>
    <ul>
        <li><label for="receveur">Bénéficiaire</label> :
        <?php
        if(isset($id)){
            Affichage::afficher_name($id);
            echo '<input type="hidden" id="receveur" name="receveur" value="'.$id.'" />';
        }
        elseif(isset($amis)){
            
            ?>
            
            
            <select id="receveur" name="receveur">
                <option value="-1">choisir un bénéficiaire</option>
            
            <?php
            foreach ($amis as $ami)
                echo '<option value="'.$ami->id.'" >'.$ami->prenom.' '.$ami->nom."</option>";
            ?>
                
            </select>
        <?php
        }
        else{
            echo 'Vous n\'avez pas accés à cette page</li>';
            return;
        }
        ?>
        </li>
        <li><label for="libelle">Libellé</label> : <input type="text" id="libelle" name="libelle"/></li>
        <li><label for="montant">Montant</label> : <input type="number" id="montant" name="montant"/></li>
        <li><input type="submit" value="Valider"</li>
    </ul>
    
</form>
        <?php
}
else{
    header("Location: ../index.php");
    return;
    
}
?>
