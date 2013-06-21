<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue)){
    header("Location: index.php");
    return;
}
if(isset($_GET['type']) && $_GET['type']=="deal"){
        ?>

<form class='formulaire_deal' action='index.php?page=operations&action=create&type=deal' method='POST'>
   <fieldset><legend> Virement à un ami </legend>
        <label for="receveur">Bénéficiaire :</label>
        <?php
        if(isset($id)){
            Affichage::afficher_name($id);
            echo '</label><input type="hidden" id="receveur" name="receveur" value="'.$id.'" />';
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
       
        <input type="text" placeholder='Libellé...' id="libelle" name="libelle"/>
        <input type="number" step='any' min='0' placeholder='0' id="montant" name="montant"/> €
        <input type="submit" value="Valider">
   </fieldset>
</form>
        <?php
}
else{
    header("Location: index.php");
    return;
    
}
?>
