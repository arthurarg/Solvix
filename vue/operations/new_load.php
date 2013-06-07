<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}
if(isset($_GET['type']) && $_GET['type']=="load"){
    ?>
<form action='index.php?page=operations&action=create&type=load' method='POST'>
    <ul>
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
