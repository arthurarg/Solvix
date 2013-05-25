<?php

Class Affichage {
    
    // Affiche un tableau d'utilisateurs
    public function afficher_users($users) {
        if ($users == null)
            return;
        echo("<table>");
        foreach ($users as $user) {
            echo("<tr>
                <td>". $user->prenom . "</td>
                <td>". $user->nom . "</td>
                <td>". $user->estAmi . "</td>
                </tr>");
        }
        echo("<table>");
    }
    
    // Affiche un tableau d'operations
    public function afficher_operations($operations) {
        if ($operations == null)
            return;
        echo("<table>");
        foreach ($operations as $op) {
            echo("<td>". $op->emetteur->prenom . " " . $op->emetteur->nom . "</td>");
            if ($op->receveur != null)
                echo("<td>". $op->receveur->prenom . " " . $op->receveur->nom . "</td>");
            else
                echo("<td> Aucun </td>");
            
            echo("<td>". $op->montant . "</td>
                <td>". $op->libelle . "</td>
                </tr>");
        }
        echo("<table>");
    }
    
    public function afficher_tableau($var) {
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