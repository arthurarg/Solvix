<?php

Class Affichage {
    
    // Affiche un tableau d'utilisateurs
    public static function afficher_users($users) {
        global $current_user;
        
        if ($users == null)
            return;
        foreach ($users as $user) {
            echo("<div class='user-box'>
                <a class='user-name' href='index.php?page=users&action=show&id=$user->id'>". $user->prenom . " " . $user->nom . "</a></td>");
            if (!$user->estAmi)
                echo("<a class='user-action' href='index.php?page=relationships&action=create&id=" . $user->id ."'>Ajouter</a>");
            else
                echo("<a class ='user-action' href='index.php?page=operations&action=new&type=deal&id=" . $user->id ."'>Virement</a>");
            echo("</div>");
        }
    }
    
    public static function afficher_name($id) {
        $user=new User($id);
        echo "<span class='name'><a href='index.php?page=users&action=show&id=$user->id'>".$user->prenom." ".$user->nom."</a></span>";
    }
    
    
    // Affiche un tableau d'operations
    public static function afficher_operations($operations) {
        if ($operations == null)
            return;
        echo("<table class='tableau_operations'>");
            echo("<tr><th> Emetteur </th><th> Receveur </th><th> Don </th><th> Libelle </th></tr>");
        foreach ($operations as $op) {
            echo("<tr><td><a href='index.php?page=users&action=show&id=".$op->emetteur->id ."'>". $op->emetteur->prenom . " " . $op->emetteur->nom . "</a></td>");
            if ($op->receveur != null)
                echo("<td><a href='index.php?page=users&action=show&id=".$op->receveur->id ."'>". $op->receveur->prenom . " " . $op->receveur->nom . "</a></td>");
            else
                echo("<td> Aucun </td>");
            
            echo("<td>". $op->montant . "</td>
                <td>". $op->libelle . "</td></tr>");
        }
        echo("</table>");
    }
    
    public static function afficher_tableau($var) {
        if ($var==null)
            return;
        
        $i=0;
        //Affichage des libellés des colonnes
        $ligne=$var->fetch();
        if ($ligne==null)
            return;
        
        echo('<table><tr>');
        foreach(array_keys($ligne) as $keys) {
            if ($i % 2 == 0)
                echo('<th>'.$keys.'</th>');
            $i++;
        }
        echo('</tr>');
        
        //Affichage des donnees
        while($ligne!=null) {
            echo('<tr>');
            foreach($ligne as $donnees) {
                if ($i % 2 == 0)
                    echo('<td>'.$donnees.'</td>');
                $i++;
            }
            echo('</tr>');
            $ligne = $var->fetch();
        }
        echo('</table>');
    }
    
    
}
?>
