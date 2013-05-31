<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($vue)){
    header("Location: ../index.php");
    return;
}
switch($_GET['type']){
    case "deal":
        ?>

<form action='index.php?page=operations&action=create&type=deal' method='POST'>
    <ul>
        <li>Receveur :
        <?php
        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>=0 && $current_user->isFriend($_GET['id'])){
            Affichage::afficher_name($_GET['id']);
            echo '<input type="hidden" name="receveur" value="'.$_GET['id'].'" />';
        }            
        else echo 'who ???';
        ?>
        </li>
        <li>Libellé : <input type="text" name="libelle"</li>
        <li>Montant : <input type="number" name="montant"</li>
        <li><input type="submit" value="Valider"</li>
    </ul>
    
</form>

        <?php
        break;
    case "transfer":
        ?>

<form action='index.php?page=operations&action=create&type=transfer' method='POST'>
    <ul>
        <li>Libellé : <input type="text" name="libelle"</li>
        <li>Montant : <input type="number" name="montant"</li>
        <li><input type="submit" value="Valider"</li>
    </ul>
    
</form>

        <?php
        break;
    default:
        header("Location: ../index.php");
        return;
        break;
    
}
?>
