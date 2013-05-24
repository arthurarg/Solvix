<?php

Class Affichage {
    
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
