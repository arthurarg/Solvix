<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Arthur
 */
class Bdd {
    public static function connection(){
        try{
           $bdd=new PDO('mysql:host=localhost;dbname=modal', 'root','');
           return $bdd;
        }
        catch(Exception $e){
            //die('Erreur : '. $e->getMessage());
            return 'connected';

        }
    }
}
?>
