<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'modele/Bdd.php';
include_once 'controleur/Connection.php';
include_once 'modele/Member.php';
include_once 'modele/Operations.php';
$a=new Member(12);
$a->affichage();
//Operations::deal($a->getId(), 8, 12, 'test');
foreach($a->getFriends() as $friend)
    $friend->affichage();

echo $a->getSolde().'<br/>';
//Operations::transfer(12, 100, 'recharge');

?>