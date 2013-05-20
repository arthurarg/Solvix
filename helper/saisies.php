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
                  && is_integer($_POST['montant']) 
                  && is_integer($_POST['receveur'])
                  && $_POST['montant'] > 0);
      }
      
      public function isTransfert() {
          return (isset($_POST['montant']) 
                  && isset($_POST['libelle'])
                  && is_integer($_POST['montant']));
      }
      
      public function isRelationShip() {
          return (isset($_GET['id']) && is_int($_GET['id']));
      }
  }  
?>
