<?php


class Relationship {
    
    public $user1, $user2;
    
    public function _construct($id1,$id2) {
        $this->user1 = new user($id1);
        $this->user2 = new user ($id2);
    }
    
    public function save() {
        
        global $bdd;
        
        $req=$bdd->prepare('INSERT INTO operations VALUES( \'\', :id1, :id2, NOW())');
        $req->execute( array(
            'id1'=>$this->user1->id,
            'id2'=>$this->user2->id));
    }
    
    public function delete() {
        
        global $bdd;
        
        $req=$bdd->prepare('DELETE FROM operations WHERE id1 = ? AND id2 = ?');
        $req->execute( array(
            'id1'=>$this->user1->id,
            'id2'=>$this->user2->id));
    }
}
?>
