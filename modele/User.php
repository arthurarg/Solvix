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
    public $email, $iban;
    public $estAmi, $last_connection, $locked;
    
    const KEY='jeu7!oQnep9&l';  //Utiliser pour renforcer sécurité mot de passe
    
    public function __construct($id) {
        global $current_user;        
        $this->id=$id;
        $this->getData();
        if ($this->id==$_SESSION['id'] || (isset($current_user) && $current_user->isFriend($this->id)))
            $this->estAmi = true;
        else
            $this->estAmi = false;
    }
    
    public function getId(){
        return $this->id;
    }
    
    private function getData(){
        global $bdd;
        
        $rep=$bdd->query("SELECT nom, prenom, email, IBAN, DATE_FORMAT(updated_at, '%d/%m/%y à %Hh%i') AS date, locked
            FROM users WHERE id=".$this->id);
        $data=$rep->fetch();
        if($data!=null){
            $this->nom=ucfirst($data['nom']);
            $this->prenom=ucfirst($data['prenom']);
            $this->email=$data['email'];
            $this->iban=$data['IBAN'];
            $this->last_connect=$data['date'];
            $this->locked=$data['locked'];
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
            $user = new User($ami['id2']);
            if (!$user->locked)
              $tab[$ami['id2']]= $user;
        }
        return $tab;
    }
    public function getSomeFriends() {
        
        global $bdd;
        $tab=array();
        //Faire un tableau d'amis et modifier fonction affichage
        $rep=$bdd->query('SELECT id2 FROM relationships WHERE id1='.$this->id. ' LIMIT 0,5');
        while(($ami = $rep->fetch()) != null) {
            $user = new User($ami['id2']);
            if (!$user->locked)
              $tab[$ami['id2']]= $user;
        }
        return $tab;
    }
    
    public function getSolde(){
        
        $solde=0;
        
        global $bdd;
        
        $rep=$bdd->query('SELECT is_deal, montant, emetteur, receveur FROM operations WHERE (emetteur='.$this->id.' OR receveur='.$this->id.') AND temporary=0');
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
        
        $req=$bdd->query('SELECT id FROM operations WHERE (emetteur =' . $this->id .' OR receveur=' . $this->id . ') AND temporary=0 ORDER BY date DESC');

        while(($op = $req->fetch()) != null) {
            $tab[$op['id']]=new Operation($op['id']);
        }
        return $tab;
    }
    
    public function getLastOperations() {
        
        global $bdd;
        $tab = array();
        $req=$bdd->query('SELECT id FROM operations WHERE (emetteur =' . $this->id . ' OR receveur=' . $this->id .') AND temporary=0 ORDER BY date DESC LIMIT 0, 5');
        while(($op = $req->fetch()) != null) {
            $tab[$op['id']] = new Operation($op['id']);
        }
        return $tab;
    }
    
    public function getCommonOperations($user) {
        
        global $bdd;
        $tab = array();
        $req=$bdd->query('SELECT id FROM operations WHERE (emetteur =' . $this->id . ' AND receveur=' . $user->id .' AND temporary=0 ) OR (emetteur =' . $user->id . ' AND receveur=' . $this->id .' AND temporary=0) ORDER BY date DESC LIMIT 0, 5');
        while(($op = $req->fetch()) != null) {
            $tab[$op['id']] = new Operation($op['id']);
        }
        return $tab;
    }
    
    public function update_password($pwd) {
        global $bdd;
        
        $req=$bdd->prepare("UPDATE users SET password=? WHERE id=?");
        $req->execute(array(sha1($pwd.self::KEY),$_SESSION['id']));
        return;
    }
    
    public function update_iban($iban) {
        global $bdd;
        
        $req=$bdd->prepare("UPDATE users SET IBAN=? WHERE id=?");
        $req->execute(array($iban,$_SESSION['id']));
        return;        
    }
    
    
    // fonction à déplacer a terme
    public function afficher_name(){
        echo $this->prenom.' '.$this->nom;
    }
    
    public static function verifierMotdePasse($email,$password) {
        
        global $bdd;
        $password = sha1($password.self::KEY);
       
        $req=$bdd->prepare("SELECT id FROM users WHERE email=? AND password=? AND locked=0");
        $req->execute(array($email, $password));
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
        
        $req=$bdd->prepare("SELECT id FROM users WHERE id=? AND locked=0");
        $req->execute(array($id));
        
        if (($req->fetch()) != null)
            return true;
        else
            return false;
    }
    
    public static function save($prenom,$nom,$mail,$password) {
        
        global $bdd;
        
        $req=$bdd->prepare("INSERT INTO users VALUES('',?,?,?,?,'', NOW(), NOW(),0)");
        return ($req->execute(array($mail,sha1($password.self::KEY),$nom,$prenom)));
    }
    
    public static function saveCrypted($nom,$prenom,$mail,$password,$crypted) {
        
        global $bdd;
        
        if($crypted!=true)
            $password=sha1($password.self::KEY);
        
        $req=$bdd->prepare("INSERT INTO users VALUES('',?,?,?,?,'', NOW(), NOW(),0)");
        return ($req->execute(array($mail,$password,$nom,$prenom)));
    }
    
    public static function maj() {
        global $bdd;
        
        $req=$bdd->prepare("UPDATE users SET updated_at=NOW() WHERE id=?");
        $req->execute(array($_SESSION['id']));    }
    
    public static function rechercher($recherche){
        
        global $bdd;
        
        $recherche= htmlspecialchars($recherche);
        
        if(strlen(str_replace(' ','',$recherche))==0)
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
