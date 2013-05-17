<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$bdd=  Bdd::connection();
if($bdd=='echec')
    echo 'impossible de se connecter<br/>';
else
    echo 'connected<br/>';
?>
