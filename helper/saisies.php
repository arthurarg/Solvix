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
      
      public function isDeal() {
          return (isset($_POST['montant']) 
                  && isset($_POST['libelle']) 
                  && isset($_POST['receveur'])
                  && (int)($_POST['receveur'] > 0)
                  && (int)$_POST['montant'] > 0);
      }
      
      public function isTransfert() {
          return (isset($_POST['montant']) 
                  && isset($_POST['libelle'])
                  && (int)($_POST['montant']) != 0);
      }
      
      public function isRelationShip() {
          return (isset($_GET['id']) && is_int($_GET['id']));
      }
  }  
?>
