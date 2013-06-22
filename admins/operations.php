<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
     $req=$bdd->prepare("SELECT id FROM operations ORDER BY date DESC");
     $req->execute();
     while(($op = $req->fetch()) != null) {
        $operations[$op['id']]=new Operation($op['id']);
     }

        
    if ($operations == null) {
        echo("Aucune opération à afficher");
        return;
    }
    echo("<table class='tableau_operations'>");
        echo("<tr><th>Emetteur</th><th>Receveur</th><th>Montant</th><th> Libelle </th><th>Date</th><th>Del </th></tr>");
    $clair=true;
    foreach ($operations as $op) {
        if($clair){
            $aff_clair="clair";
            $clair=false;
        }
        else{
            $aff_clair="fonce";
            $clair=true;
        }
        echo("<tr id=$op->id class=\"$aff_clair\">");



        echo("<td class=emetteur value=".$op->emetteur->id.">". $op->emetteur->prenom . " " . $op->emetteur->nom . "</td>");
        if ($op->receveur != null)
            echo("<td class=receveur value=".$op->receveur->id.">". $op->receveur->prenom . " " . $op->receveur->nom . "</td>");
        else
            echo("<td class=receveur value=-1> Retrait/Recharge </td>");

        
        echo("<td class=montant value=$op->montant>". $op->montant . "</td>");


        echo("<td>". $op->libelle . "</td><td>". $op->date . "</td><td><span class='admin-del' value=" .$op->id . "> <img src=../images/delete.png></span></td></tr>");
    }
    echo("</table>");

?>
