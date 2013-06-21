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
    public $libelle, $date;
    
    
    public function __construct($id) {

        global $bdd;
        $req=$bdd->prepare("SELECT id, emetteur, receveur, montant, libelle, 
            DATE_FORMAT(date, '%d/%m/%y') AS date FROM operations WHERE id=?");
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
        $this->date = $op['date'];
    }


    //Deal entre deux personnes
    public static function deal($emetteur, $receveur, $montant, $libelle){
        
        global $bdd;
        $req=$bdd->prepare('INSERT INTO operations VALUES( \'\', 1, :montant, :emetteur, :receveur, :libelle, NOW(), 0  )');
        $req->execute( array(
            'montant'=>$montant,
            'emetteur'=>$emetteur,
            'receveur'=>$receveur,
            'libelle'=>$libelle,
            ) );
        
        $user=new User($emetteur);
        Alert::add($receveur, 'Virement de '.$user->prenom.' '.$user->nom, $montant.' euros<br/>Motif : <i>'.$libelle.'</i>', true);
    }
    
    public static function ask_deal($emetteur, $receveur, $montant, $libelle){
        
        global $bdd;
        $req=$bdd->prepare('INSERT INTO operations VALUES( \'\', 1, :montant, :emetteur, :receveur, :libelle, NOW(), 1  )');
        $req->execute( array(
            'montant'=>$montant,
            'emetteur'=>$emetteur,
            'receveur'=>$receveur,
            'libelle'=>$libelle,
            ) );
        
        
        $req=$bdd->prepare('SELECT id from operations WHERE montant=:montant AND emetteur=:emetteur AND receveur=:receveur AND temporary=1');
        $rep=$req->execute( array(
            'montant'=>$montant,
            'emetteur'=>$emetteur,
            'receveur'=>$receveur,
            ) );
        
        $op=$req->fetch();
        $id=$op['id'];
        
        $user=new User($receveur);
        Alert::add($emetteur, 'Virement en attente', '<span class="gras">'.$montant.' euros</span> à '.$user->prenom.' '.$user->nom.'.<br/>
            <span class="gras">Motif :</span> <i>'.$libelle.'</i><br/>
            <a class="choix" value="index.php?page=operations&action=validate&asw=y&id='.$id.'">Accepter</a> - <a class="choix" value="index.php?page=operations&action=validate&asw=n&id='.$id.'">Refuser</a>', false);
    }
    
    //Recharge d'un compte ou retrait d'argent
    public static function transfer($emetteur, $montant, $libelle){
        
        global $bdd;
        
        $req=$bdd->prepare('INSERT INTO operations VALUES( \'\', 0, :montant, :emetteur, NULL, :libelle, NOW(), 0  )');
        $req->execute( array(
            'montant'=>$montant,
            'emetteur'=>$emetteur,
            'libelle'=>$libelle,
            ) );
    }
    
    public static function validate($asw, $id, User $emetteur){
        
        global $bdd;
        
        $solde=$emetteur->getSolde();
        $req=$bdd->prepare('SELECT * FROM operations WHERE id=? AND emetteur=? AND temporary=1');
            $req->execute( array(
                $id,
                $emetteur->id,
            ) );
            $op=$req->fetch();
            
            if($op==NULL)
                return false;
            
        if($asw=="n"){
            $req=$bdd->prepare('DELETE FROM operations WHERE id=? AND emetteur=? AND temporary=1');
            $req->execute( array(
                $id,
                $emetteur->id,
            ) );
            return true;
        }
        elseif($asw=="y"){
            if($solde<$op)
                return false;
            $req=$bdd->prepare('UPDATE operations SET temporary=0 WHERE id=? AND emetteur=? AND temporary=1');
            $req->execute( array(
                $id,
                $emetteur->id,
            ) );
            return true;
        }
        return false;
        
    }

}

?>
