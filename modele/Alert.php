<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Alert{
    
    public static function add($id, $title, $content){
        
        global $bdd;
        
        $req=$bdd->prepare('INSERT INTO alerts VALUES( \'\', :user, :title, :content, 1)');
        
        $req->execute( array(
            'user'=>$id,
            'title'=>$title,
            'content'=>$content,
            ) );
    }
    public static function get($id){
        
        global $bdd;
        $tab = array();
        
        $rep=$bdd->query('SELECT * FROM alerts WHERE user='.$id);
        while(($alert=$rep->fetch())!=null){
            $tab[$alert['id']]=$alert;
        }
        return $tab;
    }
    
    public static function erase($id, $user){
        global $bdd;
        
        $req=$bdd->prepare('DELETE FROM alerts WHERE id=? AND user=?');
        
        $req->execute( array($id, $user));
        
    }
}
?>
