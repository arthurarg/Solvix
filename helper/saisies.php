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
          return true; // A modifier
      }
      public static function isMail($string) {
          return true; // A modifier
      }
      public function isIban($string) {
          return true;
      }
      public function isIban($string) {
          return true;
      }
      
      public static function isDeal() {
          return (isset($_POST['montant']) 
                  && isset($_POST['libelle']) 
                  && isset($_POST['receveur'])
                  && (int)($_POST['receveur'] > 0)
                  && (int)$_POST['montant'] > 0);
      }
      
      public static function isTransfert() { // y'a pas de t à transfer en anglais !!!
          return (isset($_POST['montant']) 
                  && isset($_POST['libelle'])
                  && (int)($_POST['montant']) != 0);
      }
      
      public static function isRelationShip() {
          return (isset($_GET['id']) && is_int($_GET['id']));
      }
      
      public static function isInscriptionValide() {
          return (isset($_POST['nom']) && Saisies::isName($_POST['nom']) 
                  && isset($_POST['prenom']) && Saisies::isName($_POST['prenom'])
                  && isset($_POST['mail']) && Saisies::isMail($_POST['mail'])
                  && isset($_POST['password'])
                  && isset($_POST['confirmation'])
                  && $_POST['password']===$_POST['confirmation']);
      }
      
      public function isValidUpdate() {
          if (!isset($_POST['password']))
              return false;
          if (isset($_POST['new_password'])) {
              if (!isset($_POST['new_confirmation']) || !($POST['new_confirmation']===$POST['new_password']))
                  return false;
          }
          if (isset($_POST['iban']) && !Saisies::isIBAN($_POST['iban']))
              return false;
          
          return true;
              
      }
  }  
?>
