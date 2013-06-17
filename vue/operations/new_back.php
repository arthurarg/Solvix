<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}
if(isset($_GET['type']) && $_GET['type']=="back"){
    ?>
<form class='formulaire_deal' action='index.php?page=operations&action=create&type=back' method='POST'>
    <fieldset><legend> Retirer de l'argent </legend>
    <input type="text" placeholder='Libellé...' id="libelle" name="libelle"/>
    <input type="number" step='any' min='0' placeholder='0' id="montant" name="montant"/> €
    <input type="submit" value="Valider">
    </fieldset>
</form>

        <?php
}
else{
    header("Location: ../index.php");
    return;
}
?>
