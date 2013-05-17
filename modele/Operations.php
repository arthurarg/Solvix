<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Operations
 *
 * @author Arthur
 */
class Operations {
    //put your code here
    public static function deal($emetteur, $receveur, $montant, $libelle){
        
        global $bdd;
        
        $req=$bdd->prepare('INSERT INTO operations VALUES( \'\', 1, :montant, :emetteur, :receveur, :libelle, NOW()  )');
        $req->execute( array(
            'montant'=>$montant,
            'emetteur'=>$emetteur,
            'receveur'=>$receveur,
            'libelle'=>$libelle,
            ) );
    }
    
    public static function transfer($emetteur, $montant, $libelle){
        
        global $bdd;
        
        $req=$bdd->prepare('INSERT INTO operations VALUES( \'\', 0, :montant, :emetteur, NULL, :libelle, NOW()  )');
        $req->execute( array(
            'montant'=>$montant,
            'emetteur'=>$emetteur,
            'libelle'=>$libelle,
            ) );
    }
}

?>
