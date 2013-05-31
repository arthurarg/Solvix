<?php


class Relationship {
    
    public $user1, $user2;

    
    public static function save($id1,$id2) {
        global $bdd;
        
        $req=$bdd->prepare("INSERT INTO relationships VALUES('',?,?,NOW())");
        $req->execute(array($id1,$id2));
    }
    
    public static function delete($id1,$id2) {
        
        global $bdd;
        
        $req=$bdd->prepare('DELETE FROM operations WHERE id1 = ? AND id2 = ?');
        $req->execute(array($id1,$id2));
    }
}
?>
