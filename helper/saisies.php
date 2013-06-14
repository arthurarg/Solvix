<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Ce fichier traite les entrées de l'utilisateur pour empécher les bugs...
 *
 * @author Arthur
 */


  class Saisies {
      
      public static function isName($string) {
          return preg_match("#^[a-z]+$#",$string);
      }
      public static function isMail($string) {
          return preg_match("#^[a-z0-9-_.]+@[a-z]{2,}\.[a-z]{2,4}$#",$string);
      }
      public function isIban($string) {
            $other_string = substr($string,4) . substr($string,0,4);
            $chars=str_split($other_string);
            $new_string='';
            foreach($chars as $char) {
                if (!is_numeric($char))
                  $new_string= $new_string . (ord($char)-87);
                else
                  $new_string= $new_string . $char;  
            }
            while (strlen($new_string) > 2) {
                $new_string = (int)(substr($new_string,0,8))%97 . substr($new_string,8);
            }
            $final_string = $new_string%97; // (cas ou ça vaut 98)
            return($final_string==1);
      }
      
      public static function isDealSafe() {
          return (!empty($_POST['montant']) 
                  && !empty($_POST['libelle']) 
                  && !empty($_POST['receveur'])
                  && $_POST['montant'] > 0
                  && (int)$_POST['receveur']!=0
                  && ($_POST['receveur']>0 || $_POST['receveur']==-1)
                  );
      }
      
      public static function isTransfert() { // y'a pas de t à transfer en anglais !!!
          return (!empty($_POST['montant']) 
                  && !empty($_POST['libelle'])
                  && (int)($_POST['montant']) != 0
                  && $_POST['montant']>0);
      }
      
      public static function isRelationShip() {
          return (isset($_GET['id']) && is_numeric($_GET['id']));
      }
      
      public static function isInscriptionValide() {
          return (!empty($_POST['nom']) && Saisies::isName($_POST['nom']) 
                  && !empty($_POST['prenom']) && Saisies::isName($_POST['prenom'])
                  && !empty($_POST['mail']) && Saisies::isMail($_POST['mail'])
                  && !empty($_POST['password'])
                  && !empty($_POST['confirmation'])
                  && $_POST['password']===$_POST['confirmation']);
      }
      
      public static function isValidUpdate() {
          if (empty($_POST['password']))
              return false;
          if (!empty($_POST['new_password'])) {
              if (!empty($_POST['new_confirmation']) || !($_POST['new_confirmation']===$_POST['new_password']))
                  return false;
          }
          if (!empty($_POST['iban']) && !Saisies::isIBAN($_POST['iban']))
              return false;
          
          return true;
              
      }
  }  
?>
