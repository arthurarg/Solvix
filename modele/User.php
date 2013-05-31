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
    public $estAmi;
    
    public function __construct($id) {
        global $current_user;        
        $this->id=$id;
        $this->getData();
        if ($this->id==$_SESSION['id'] || $current_user->isFriend($this->id))
            $this->estAmi = true;
        else
            $this->estAmi = false;
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
    
    public function isFriend($id2) {
        global $bdd;
        
        $req=$bdd->prepare('SELECT id2 FROM relationships WHERE id1='.$this->id.' AND id2=?');
        $req->execute(array($id2));
        
        if($req->fetch()==null)
            return false;
        else
            return true;
    }
    
    public function getFriends(){
        
        global $bdd;
        $tab = array();
        
        $rep=$bdd->query('SELECT id2 FROM relationships WHERE id1='.$this->id);
        while(($ami = $rep->fetch()) != null) {
            $tab[$ami['id2']]=new User($ami['id2']);
        }
        return $tab;
    }
    public function getSomeFriends() {
        
        global $bdd;
        $tab=array();
        //Faire un tableau d'amis et modifier fonction affichage
        $rep=$bdd->query('SELECT id2 FROM relationships WHERE id1='.$this->id);
        while(($ami = $rep->fetch()) != null) {
            $tab[$ami['id2']]=new User($ami['id2']);
        }
        return $tab;
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
    
    public function getOperations() {
        
        global $bdd;
        $tab = array();
        
        $req=$bdd->query('SELECT id FROM operations WHERE emetteur =' . $this->id .' OR receveur=' . $this->id . ' ORDER BY date DESC LIMIT 0, 5');

        while(($op = $req->fetch()) != null) {
            $tab[$op['id']]=new Operation($op['id']);
        }
        return $tab;
        return $req;
    }
    
    public function getLastOperations() {
        
        global $bdd;
        $tab = array();
        $req=$bdd->query('SELECT id FROM operations WHERE emetteur =' . $this->id . ' OR receveur=' . $this->id .' ORDER BY date DESC LIMIT 0, 5');
        while(($op = $req->fetch()) != null) {
            $tab[$op['id']] = new Operation($op['id']);
        }
        return $tab;
    }
    
    public function getCommonOperations($user) {
        
        global $bdd;
        $tab = array();
        $req=$bdd->query('SELECT id FROM operations WHERE (emetteur =' . $this->id . ' AND receveur=' . $user->id .') OR (emetteur =' . $user->id . ' AND receveur=' . $this->id .') ORDER BY date DESC LIMIT 0, 5');
        while(($op = $req->fetch()) != null) {
            $tab[$op['id']] = new Operation($op['id']);
        }
        return $tab;
    }
    
    public function update_password($pwd) {
        global $bdd;
        
        $req=$bdd->prepare("UPDATE users SET password=? WHERE id=?");
        $req->execute(array(sha1($pwd),$_SESSION['id']));
        return;
    }
    
    public function update_iban($iban) {
        global $bdd;
        
        $req=$bdd->prepare("UPDATE users SET IBAN=? WHERE id=?");
        $req->execute(array($iban,$_SESSION['id']));
        return;        
    }
    
    
    // fonction à déplacer a terme
    public function affichage(){
        echo $this->prenom.' '.$this->nom.' ('.$this->email.')<br/>';
    }
    
    public static function verifierMotdePasse($email,$password) {
        
        global $bdd;
        $password = sha1($password);
       
        $req=$bdd->prepare("SELECT id FROM users WHERE email= ? AND password= ?");
        $req->execute( array($email, $password));
        $donnees = $req->fetch();

        return $donnees['id'];
        
    }
    
    public static function exists($mail) {
        
        global $bdd;
        
        $req=$bdd->prepare("SELECT id FROM users WHERE email=?");
        $req->execute(array($mail));
        
       if (($donnees = $req->fetch()) != null)
           return $donnees['id'];
       else
           return false;
    }
    
    public static function isUser($id) {
        global $bdd;
        
        $req=$bdd->prepare("SELECT id FROM users WHERE id=?");
        $req->execute(array($id));
        
        if (($req->fetch()) != null)
            return true;
        else
            return false;
    }
    
    public static function save($prenom,$nom,$mail,$password) {
        
        global $bdd;
        
        $req=$bdd->prepare("INSERT INTO users VALUES('',?,?,?,?,'', NOW(), NOW())");
        return ($req->execute(array($mail,sha1($password),$nom,$prenom)));
    }
    
    public static function rechercher($recherche){
        
        global $bdd;
        
        $recherche=  htmlspecialchars($recherche);
        
        if(strlen($recherche)==0)
            return 0;
        
        $mots=  preg_split("# #", $recherche);
        
        if(count($mots)>=2){
            $req=$bdd->prepare('SELECT id FROM users WHERE (prenom LIKE \''.$mots[0].'%\' AND nom LIKE \''.$mots[1].'%\') OR (prenom LIKE \''.$mots[1].'%\' AND nom LIKE \''.$mots[0].'%\') ');
        }
        else{
            $req=$bdd->prepare('SELECT id FROM users WHERE prenom LIKE \''.$recherche.'%\' OR nom LIKE \''.$recherche.'%\'');
        }
        $req->execute();
        
        while($rep=$req->fetch())
            $res[$rep['id']]=new User($rep['id']);
        
        if(!isset($res))
            return 0;
        
        return $res;
        
    }
}

?>
