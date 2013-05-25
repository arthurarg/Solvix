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
class Operation {
    
    public $id;
    public $emetteur, $receveur;
    public $montant;
    public $libelle;
    
    
    public function __construct($id) {

        global $bdd;
        $req=$bdd->prepare("SELECT * FROM operations WHERE id=?");
        $req->execute(array($id));
        $op = $req->fetch();
        
        $this->id = $op['id'];
        $this->emetteur = new User($op['emetteur']);
        if ($op['receveur'] != null)
            $this->receveur = new user($op['receveur']);
        else
            $this->receveur = null;
        $this->montant = $op['montant'];
        $this->libelle = $op['libelle'];
    }


    //Deal entre deux personnes
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
    
    //Recharge d'un compte ou retrait d'argent
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
