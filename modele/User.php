<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Member
 * à fair évoluer éventuellement pour représenter un membre de manière plus générale (qui n'existe pas forcément dans la bdd
 *
 * @author Arthur
 */
class User {
    public $id;
    public $nom, $prenom;
    public $email;
    
    public function __construct($id) {
        $this->id=$id;
        $this->getData();
    }
    
    public function getId(){
        return $this->id;
    }
    
    private function getData(){
        global $bdd;
        
        $rep=$bdd->query('SELECT * FROM users WHERE id='.$this->id);
        $data=$rep->fetch();
        if($data!=null){
            $this->nom=$data['nom'];
            $this->prenom=$data['prenom'];
            $this->email=$data['email'];
        }
    }
    
    public function getFriends(){
        
        $friends=array();
        
        global $bdd;
        
        $rep=$bdd->query('SELECT id1, id2 FROM relationships WHERE id1='.$this->id.' OR id2='.$this->id);
        while($d=$rep->fetch()){
            if($d['id1']==$this->id)
                $friends[$d['id2']]=new Member($d['id2']);
            elseif($d['id2']==$this->id)
                $friends[$d['id1']]=new Member($d['id1']);
        }
        return $friends;
    }
    
    public function getSolde(){
        
        $solde=0;
        
        global $bdd;
        
        $rep=$bdd->query('SELECT is_deal, montant, emetteur, receveur FROM operations WHERE emetteur='.$this->id.' OR receveur='.$this->id);
        while($d=$rep->fetch()){
            if($d['is_deal']){
                if($d['emetteur']==$this->id)
                    $solde=$solde-$d['montant'];
                elseif($d['receveur']==$this->id)
                    $solde=$solde+$d['montant'];
            }
            else
                $solde=$solde+$d['montant'];
        }
        return $solde;
    }
    
    // fonction à déplacer a terme
    public function affichage(){
        echo $this->prenom.' '.$this->nom.' ('.$this->email.')<br/>';
    }
    
    public function verifierMotdePasse($email,$password) {
        
        global $bdd;
        $password = sha1($password);
       
        $req=$bdd->query("SELECT id FROM users WHERE email= 'jeanmaxime.pasquet@gmail.com'");
        $donnees = $req->fetch();

        return $donnees['id'];
        
    }
}

?>
