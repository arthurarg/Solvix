<?php


class Relationship {
    
    public function save($id) {
        
        global $bdd;
        
        $req=$bdd->prepare('INSERT INTO operations VALUES( \'\', :id1, :id2, NOW())');
        $req->execute( array(
            'id1'=>$_SESSION['id'],
            'id2'=>$id));
    }
    
    public function delete($id) {
        
        global $bdd;
        
        $req=$bdd->prepare('DELETE FROM operations WHERE id1 = ? AND id2 = ?');
        $req->execute( array(
            'id1'=>$_SESSION['id'],
            'id2'=>$id));
        $req->execute( array(
            'id2'=>$_SESSION['id'],
            'id1'=>$id));
    }
}
?>
