<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Registration{
    
    public static function newRegistration($nom, $prenom, $mail, $password) {

        global $bdd;
        
        $code="";
        for($i=1;$i<10;$i++){
            $code=$code+chr(mt_rand(65, 90));
        }
        $code=sha1($code);

        $req=$bdd->prepare("INSERT INTO registration VALUES('',?,?,?,?,?, NOW())");
        $req->execute(array($mail, sha1($password.'jeu7!oQnep9&l'), $nom, $prenom, $code));
        
        return $code;
    }
    public static function exists($mail) {
        
        global $bdd;
        
        $req=$bdd->prepare("SELECT id FROM registration WHERE email=?");
        $req->execute(array($mail));
        
       if (($donnees = $req->fetch()) != null)
           return $donnees['id'];
       else
           return false;
    }
    public static function get($id){
        global $bdd;
        
        $req=$bdd->prepare("SELECT * FROM registration WHERE id=?");
        $req->execute(array($id));
        
        return $req->fetch();
    }
    public static function erase($id){
        global $bdd;
        
        $req=$bdd->prepare("DELETE FROM registration WHERE id=?");
        $req->execute(array($id));
        
        return $req->fetch();
    }
    
}
?>
