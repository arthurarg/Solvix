<?php

Class Affichage {
    
    // Affiche un tableau d'utilisateurs
    public static function afficher_users($users) {
        global $current_user;
        
        if ($users == null) {
            echo("Aucun utilisateur à afficher");
            return;
        }
        
        foreach ($users as $user) {
            if (!$user->locked) {
                echo("<div class='user-box'>
                    <a class='user-name' href='index.php?page=users&action=show&id=$user->id'>". $user->prenom . " " . $user->nom . "</a></td>");
                if (!$user->estAmi)
                    echo("<a class='user-action' href='index.php?page=relationships&action=create&id=" . $user->id ."'>Ajouter</a>");
                else if($user->id!=$current_user->id)
                    echo("<a class ='user-action' href='index.php?page=operations&action=new&type=deal&id=" . $user->id ."'>Virement</a>");
                echo("</div>");
            }
        }
    }
    
    public static function afficher_name($id) {
        $user=new User($id);
        echo "<span class='name'><a href='index.php?page=users&action=show&id=$user->id'>".$user->prenom." ".$user->nom."</a></span>";
    }
    
    
    // Affiche un tableau d'operations
    public static function afficher_operations($operations) {
        global $current_user;
        
        if ($operations == null) {
            echo("Aucune opération à afficher");
            return;
        }
        echo("<table class='tableau_operations'>");
            echo("<tr><th> De/A </th><th>Montant</th><th> Libelle </th><th>Date</th></tr>");
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
            echo("<tr class=\"$aff_clair\">");
            
            
            if ($op->emetteur->id != $current_user->id) 
                echo("<td><a href='index.php?page=users&action=show&id=".$op->emetteur->id ."'>". $op->emetteur->prenom . " " . $op->emetteur->nom . "</a></td>");
            else if ($op->receveur != null)
                echo("<td><a href='index.php?page=users&action=show&id=".$op->receveur->id ."'>". $op->receveur->prenom . " " . $op->receveur->nom . "</a></td>");
            else
                echo("<td> Retrait/Recharge </td>");
            
            
            if ($op->emetteur->id==$current_user->id && ($op->receveur!=null ||$op->montant<0 ))
                echo("<td>". - abs($op->montant) . "</td>");
            else
                echo("<td>". $op->montant . "</td>");
                
            
            echo("<td>". $op->libelle . "</td><td>". $op->date . "</td></tr>");
        }
        echo("</table>");
    }

    
    
}
?>
